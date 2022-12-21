<?php

namespace App\Http\Controllers;

class memorialcontroller extends Controller
{
    public function index()
    {
        return view('jurnal.memorial.memo');
    }
}
