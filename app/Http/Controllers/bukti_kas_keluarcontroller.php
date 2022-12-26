<?php

namespace App\Http\Controllers;


use App\Models\bukti_kas_keluar;
use Illuminate\Http\Request;

class bukti_kas_keluarcontroller extends Controller
{
    public function index()
    {


        return view('BuktiKasKeluar.index');
    }
}