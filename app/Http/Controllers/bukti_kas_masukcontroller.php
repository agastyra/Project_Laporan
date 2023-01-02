<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bukti_kas_masukcontroller extends Controller
{
    public function form()
    {
        return view('BuktiKasMasuk.form');
    }

    public function report()
    {
        return view('BuktiKasMasuk.report');
    }

    public function tabel()
    {
        return view('BuktiKasMasuk.tb_kas_masuk');
    }
}