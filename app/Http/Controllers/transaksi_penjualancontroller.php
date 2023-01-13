<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranSaleRequest;
use App\Models\barang;
use App\Models\customer;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
use Illuminate\Http\Request;


class transaksi_penjualancontroller extends Controller
{
    public function index()
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

    public function create($transaksiId)
    {
        if (is_null($transaksiId)) {
            abort(404);
        }

        $details = detail_penjualan::with([
            'barang'
        ])->where('transaksi_penjualans_id', $transaksiId);

        $items = $details->get();
        $subTotal = $details->sum('subTotal');

        return view('transaksi.penjualan.sales', [
            'transaksiId' => $transaksiId,
            'items' => $items,
            'subTotal' => $subTotal
        ]);
    }

    public function store(TranSaleRequest $request)
    {
        $request = $request->all();

        $data['customer_id'] = $request['customer_id'];
        $data['sub_total'] = str_replace(',', '', $request['sub_total']);
        $data['grand_total'] = str_replace(',', '', $request['grand_total']);
        $data['bayar'] = str_replace(',', '', $request['bayar']);
        $data['kembali'] = str_replace(',', '', $request['kembali']);
        $data['valid'] = true;

        $transaksiId = now()->format('dmyHis') . transaksi_penjualan::all()->count();

        transaksi_penjualan::where('no_transaction', $request['no_transaction'])
            ->update($data);

        return redirect()->route('transaksi.create', $transaksiId)->with(['success' => 'Transaksi Berhasil Disimpan', 'no_transaction' => $request['no_transaction']]);

    }

    public function search(Request $request)
    {
        // $keyword = $request->input('keyword');
        // $barangs = collect([]);
        // if ($keyword) {
        //     $barangs = barang::query()
        //         ->where('no_barang', 'like', "%{$keyword}%")
        //         ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
        // }

        // return view('transaksi.penjualan.sales', compact('barangs'));
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
            // 'date' => $trans->date->toDateTimeString(),
            // 'customerId' => $trans->customer_id,
            // 'bayar' => $trans->bayar,
            // 'kembali' => $trans->kembali
        ];

        return view('transaksi.penjualan.sales', [
            'title' => $title,
            'transaksiId' => $transaksiId,
            'items' => $items,
            'customers' => $customers,
            'subTotal' => $subTotal,
            'data' => $data
        ]);
    }

    
}