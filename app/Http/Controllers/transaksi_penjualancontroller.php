<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranSaleRequest;
use App\Models\barang;
use App\Models\customer;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transaksi_penjualancontroller extends Controller
{
    public function index($transaksiId = null)
    {
        $title = "Transaksi Penjualan";
        $items = transaksi_penjualan::with([
            'customer'
        ])->where('valid', true)->get();
        return view("transaksi.penjualan.index", [
            'title' => $title,
            'items' => $items
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
        $title = "Transaksi Penjualan";
        $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'))->first();
        if ($noTrans) {
            $tranCode = ((int) $noTrans->noTrans + date('dm'));
        } else {
            $tranCode = 1;
        }

        $Gtotals = 0;
        $barangs = barang::all();
        $details = detail_penjualan::where('no_transaction', $tranCode)->get();
        if ($details->count() > 0) {
            $totals = DB::table('detail_penjualans')->select(DB::raw('SUM(subTotal) as Gtotal'))
                ->where('no_transaction', $tranCode)->groupBy('no_transaction')->first();
            $Gtotals = $totals->Gtotal;
        }

        $dates = date('dmyHis');

        return view('transaksi.penjualan.create', [
            'title' => $title,
            'dates' => $dates,
            'barangs' => $barangs,
            'transCode' => $tranCode,
            'details' => $details,
            'Gtotals' => $Gtotals
        ]);
    }

    public function getData($id)
    {
        $barang = Barang::find($id);
        return response()->json([
            'subTotal' => $barang->harga_jual,
        ]);
    }

    public function calculate(Request $request){
        $bayar = $request->bayar;
        $grand_total = $request->grand_total;
        $kembali = $bayar - $grand_total;

        return response()->json(['kembali' => $kembali]);
    }

    
    public function store(Request $request)
    {
        $date = date('dmyHis');
        $storeTrans = transaksi_penjualan::create([
            'no_transaction' => $request->no_transaction,
            'date' => $date,
            'grand_total' => $request->grand_total,
            'bayar' => $request->bayar,
            'kembali' => $request->kembali
        ]);

        return redirect()->route('transaksi.create');
    }


    public function show($tranCode)
    {
        $title = 'Daftar Transaksi';

        $details = detail_penjualan::with([
            'barang'
        ])->where('no_transaction', $tranCode);

        $items = $details->get();
        $subTotal = $details->sum('subTotal');

        $customers = customer::all();

        $trans = transaksi_penjualan::with([
            'customer'
        ])->where('no_transaction', $tranCode)
            ->where('valid', true)
            ->first();

        $data = [
            'date' => $trans->date->toDateTimeString(),
            'customerId' => $trans->customer_id,
            'bayar' => $trans->bayar,
            'kembali' => $trans->kembali
        ];

        return view('transaksi.penjualan.show', [
            'title' => $title,
            'transaksiId' => $tranCode,
            'items' => $items,
            'customers' => $customers,
            'subTotal' => $subTotal,
            'data' => $data
        ]);
    }


}