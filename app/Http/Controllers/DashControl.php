<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashControl extends Controller
{
    public function index()
    {
        return view('dashboard.dash');
    }
}
