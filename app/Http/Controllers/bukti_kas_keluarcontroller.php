<?php

namespace App\Http\Controllers;

class bukti_kas_keluarcontroller extends Controller
{
    public function report()
    {
        return view('BuktiKasKeluar.report');
    }


    public function jurnal()
    {
        return view('BuktiKasKeluar.tb_kas_keluar');
    }

    public function form()
    {
        return view('buktikaskeluar.form');
    }

    public function nota()
    {
        return view('BuktiKasKeluar.nota_pembelian');
    }
}