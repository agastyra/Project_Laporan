<?php

namespace App\Http\Controllers;

use App\Models\barang;

class transaksi_pembeliancontroller extends Controller
{
    public function index()
    {
        $barangs = barang::orderBy('no_barang', 'asc')->get();

        return view('transaksi.pembelian.purch', [
            'barangs' => $barangs,
        ]);
    }

    public function cari_barang(barang $barang)
    {
        $result = barang::where('no_barang', $barang->no_barang)->get();

        return response()->json(['result' => $result]);
    }
}
