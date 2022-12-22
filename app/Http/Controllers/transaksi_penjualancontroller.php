<?php

namespace App\Http\Controllers;

class transaksi_penjualancontroller extends Controller
{
    public function index()
    {
        return view("transaksi.penjualan.sales");
    }
}
