<?php

namespace App\Http\Controllers;

class bukti_kas_keluarcontroller extends Controller
{
    public function index()
    {
        return view('BuktiKasKeluar.index');
    }


    public function jurnal()
    {
        return view('BuktiKasKeluar.tb_kas_keluar');
    }

    public function form()
    {
        return view('buktikaskeluar.form');
    }
}