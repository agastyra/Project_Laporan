<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jurnal_penyesuaiancontroller extends Controller
{
    public function index()
    {
        return view('jurnal.penyesuaian.penyesuaian');
    }
}