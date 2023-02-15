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



    public function create(Request $request)
{
    $keyword = $request->input('keyword');
    $barbar = collect([]);
    if ($keyword) {
        $barbar = barang::query()
            ->where('no_barang', 'like', "%{$keyword}%")
            ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
    }

    $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'))->first();
    if ($noTrans) {
        $tranCode = now()->format('dmyHis') . ((int) $noTrans->noTrans + 1);
    } else {
        $tranCode = now()->format('dmyHis') . '1';
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
        'barbar' => $barbar,
        'dates' => $dates,
        'barangs' => $barangs,
        'transCode' => $tranCode,
        'details' => $details,
        'Gtotals' => $Gtotals
    ]);
}

    // public function create(Request $request)
    // {

    //     $keyword = $request->input('keyword');
    //     $barbar = collect([]);
    //     if ($keyword) {
    //         $barbar = barang::query()
    //             ->where('no_barang', 'like', "%{$keyword}%")
    //             ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
    //     }

    //     $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'));
    //     if ($noTrans->count() > 0) {
    //         foreach($noTrans->get() as $pKey){
    //             $tranCode = now()->format('dmyHis') . ((int) $pKey->noTrans + 1);
    //         }
    //     }else{
    //         $tranCode = 1;
    //     }

    //     $Gtotals = 0;

    //     $barangs = barang::all();
    //     $details = detail_penjualan::where('no_transaction', $tranCode)->get();
    //     if ($details->count() > 0) {
    //         $totals = DB::table('detail_penjualans')->select(DB::raw('SUM(subTotal) as Gtotal'))
    //             ->where('no_transaction', $tranCode)->groupBy('no_transaction')->first();
    //         $Gtotals = $totals->Gtotal;
    //     }

    //     $dates = date('dmyHis');

    //     return view('transaksi.penjualan.create', [
    //         'barbar' => $barbar,
    //         'dates' => $dates,
    //         'barangs' => $barangs,
    //         'transCode' => $tranCode,
    //         'details' => $details,
    //         'Gtotals' => $Gtotals
    //     ]);

       
    // }

     // return dd($noTrans, $barangs, $details, $transCode, $Gtotals, $dates);
        // if (is_null($transaksiId)) {
        //     abort(404);
        // }
        // $noTrans = now()->format('dmyHis');

        // $details = detail_penjualan::where('no_transaction', '=', 'no_transaction')->get();
        // $items = $details->firstOrFail();

        // return dd($items);

        // $details = DB::table('detail_penjualans')->where('barang_id')->get();
        // $barangs = $details->barang_id;

        // return view('transaksi.penjualan.create', [
        //     'noTrans' => $noTrans,
        //     'details' => $details
        // ]);

        // $test = detail_penjualan::findOrFail(1);
        // $stok = $test->barang->name_barang;

    public function store(TranSaleRequest $request, $tranCode)
    {
        $request = $request->all();

        $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'));
        if ($noTrans->count() > 0) {
            foreach($noTrans->get() as $pKey){
                $tranCode = now()->format('dmyHis') . ((int) $pKey->noTrans + 1);
            }
        }else{
            $tranCode = 1;
        }

        $Gtotal = 

        $tranCreate = transaksi_penjualan::create([
            'no_transaction' => $tranCode,
        ]);

        
        // $data['customer_id'] = $request['customer_id'];
        // $data['sub_total'] = str_replace(',', '', $request['sub_total']);
        // $data['grand_total'] = str_replace(',', '', $request['grand_total']);
        // $data['bayar'] = str_replace(',', '', $request['bayar']);
        // $data['kembali'] = str_replace(',', '', $request['kembali']);
        // $data['valid'] = true;

        // $transaksiId = now()->format('dmyHis') . transaksi_penjualan::all()->count();

        // transaksi_penjualan::where('no_transaction', $request['no_transaction'])
        //     ->update($data);

        return redirect()->route('transaksi.create', $tranCode)->with(['success' => 'Transaksi Berhasil Disimpan', 'no_transaction' => $request['no_transaction']]);

    }


    public function show($transaksiId)
    {
        $title = 'Daftar Transaksi';

        $details = detail_penjualan::with([
            'barang'
        ])->where('no_transaction', $transaksiId);

        $items = $details->get();
        $subTotal = $details->sum('subTotal');

        $customers = customer::all();

        $trans = transaksi_penjualan::with([
            'customer'
        ])->where('no_transaction', $transaksiId)
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
            'transaksiId' => $transaksiId,
            'items' => $items,
            'customers' => $customers,
            'subTotal' => $subTotal,
            'data' => $data
        ]);
    }


}