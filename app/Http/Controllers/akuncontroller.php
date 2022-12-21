<?php

namespace App\Http\Controllers;

use App\Models\akun;

class akuncontroller extends Controller
{
    public function index()
    {
        $akuns = akun::all();

        return view('akun.index', compact('akuns'));
    }

    public function show($id)
    {
        $akun = Akun::find($id);

        return view('akun.show', compact('akun'));
    }

}
