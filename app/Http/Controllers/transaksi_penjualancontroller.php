<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory;


class transaksi_penjualancontroller extends Controller
{
    public function index()
    {
        $title = "Transaksi Penjualan";
        $transaksis = DB::table('transaksi_penjualans')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(grand_total) as total'), 'no_transaction', 'date')
            ->groupBy('month', 'no_transaction', 'date')
            ->get();


        return view('transaksi.penjualan.index', [
            'title' => $title,
            'transaksis' => $transaksis,
        ]);
    }


    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');
    //     $barbar = collect([]);
    //     if ($keyword) {
    //         $barbar = barang::query()
    //             ->where('no_barang', 'like', "%{$keyword}%")
    //             ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
    //     }

    //     return view('transaksi.penjualan.create', compact('barbar'));
    // }



    public function create()
    {
        $tranCode = transaksi_penjualan::latest()->first();
        if ($tranCode) {
            $tranCode = substr($tranCode->no_transaction, -1);
            $newCodeNumber = $tranCode + 1;
            $tranCode = 'STRX' . $newCodeNumber;
        } else {
            $tranCode = 'STRX1';
        }
        $Gtotals = 0;
        $barangs = barang::all();
        $details = detail_penjualan::where('no_transaction', $tranCode)->get();
        if ($details->count() > 0) {
            $totals = DB::table('detail_penjualans')->select(DB::raw('SUM(subTotal) as Gtotal'))
                ->where('no_transaction', $tranCode)->groupBy('no_transaction')->first();
            $Gtotals = $totals->Gtotal;
        }
        $dates = date('d-m-Y H:i:s');

        return view('transaksi.penjualan.create', [
            'dates' => $dates,
            'barangs' => $barangs,
            'details' => $details,
            'Gtotals' => $Gtotals,
            'no_transaction' => $tranCode
        ]);
    }

    // $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'))->first();
    // if ($noTrans) {
    //     $tranCode = ((int) $noTrans->noTrans + date('dm'));
    // } else {
    //     $tranCode = 1;
    // }

    public function getData($id)
    {
        $barang = Barang::find($id);
        return response()->json([
            'harga_jual' => $barang->harga_jual,
        ]);
    }

    public function calculate(Request $request)
    {
        $bayar = $request->bayar;
        $grand_total = $request->grand_total;
        $kembali = $bayar - $grand_total;

        return response()->json(['kembali' => $kembali]);
    }

    public function calcSub(Request $request)
    {
        $harga_jual = $request->harga_jual;
        $qty = $request->qty;
        $subTotal = $harga_jual * $qty;

        return response()->json(['subTotal' => $subTotal]);
    }


    public function store(Request $request)
    {
        $date = date('ymdHis');
        $storeTrans = transaksi_penjualan::create([
            'no_transaction' => $request->no_transaction,
            'date' => $date,
            'grand_total' => $request->grand_total,
            'bayar' => $request->bayar,
            'kembali' => $request->kembali
        ]);

        return redirect()->route('transaksi.index');
    }

    public function print(Request $request)
    {
        $sales = transaksi_penjualan::where('no_transaction', $request->no_transaction)->first();
        $detail = detail_penjualan::where('no_transaction', $request->no_transaction)->get();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $config = app(Repository::class);
        $files = app(Filesystem::class);
        $view = app(Factory::class);
        $pdf = new PDF($dompdf, $config, $files, $view);
        $pdf->loadView('transaksi.penjualan.nota', [
            'sales' => $sales,
            'detail' => $detail,
        ]);
        $pdf->stream('transaksi.penjualan.nota');
    }
}