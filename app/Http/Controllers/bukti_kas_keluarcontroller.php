<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\transaksi_pembelian;

class bukti_kas_keluarcontroller extends Controller
{
    public function index()
    {
        return view('BuktiKasKeluar.index');
    }

    public function form()
    {
        $akuns = akun::where('is_header_account', false)->orderBy('no_account', 'asc')->get();
        $transaksis = transaksi_pembelian::where('is_display', true)->orderBy('no_transaction', 'asc')->get();

        return view('buktikaskeluar.form', [
            'akuns' => $akuns,
            'transaksis' => $transaksis,
        ]);
    }

    public function jurnal()
    {
        return view('BuktiKasKeluar.tb_kas_keluar');
    }

    public function report()
    {
        return view('BuktiKasKeluar.report');
    }

    public function nota()
    {
        return view('BuktiKasKeluar.nota_pembelian');
    }
}
