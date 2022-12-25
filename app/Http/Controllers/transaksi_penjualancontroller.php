<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transaksi_penjualancontroller extends Controller
{

    public $nota;
    public function index(Request $request)
    {
        $sales = DB::table('transaksi_penjualans')->select(DB::raw('MAX(id) as NSale'));
        if ($sales->count() > 0) {
            foreach ($sales->get() as $key) {
                $this->nota = ((int) $key->NSale + 1);
            }
        } else {
            $this->nota = 1;
        }

        $date = date('Y-m-d');
        $barangs = barang::all();
        $detail = detail_penjualan::where('transaksi_penjualans_id', $this->nota)->get();
        return view("transaksi.penjualan.sales", [
            'barangs' => $barangs,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $barangs = collect([]);
        if ($keyword) {
            $barangs = barang::query()
                ->where('no_barang', 'like', "%{$keyword}%")
                ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
        }

        return view('transaksi.penjualan.sales', compact('barangs'));
    }
}