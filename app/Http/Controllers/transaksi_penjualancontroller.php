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
        $barangs = barang::where([
            ['name_barang', '!=', null],
            [
                function ($query) use ($request) {
                    if (($term = $request->term)) {
                        $query->orWhere('name_barang', 'LIKE', '%' . $term . '%')->get();
                    }
                }
            ]
        ])
            ->orderBy('id')
            ->paginate(10);
        $detail = detail_penjualan::where('transaksi_penjualans_id', $this->nota)->get();
        return view("transaksi.penjualan.sales", compact('barangs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

// public function searchBarang(Request $request)
// {
//     $barangs = barang::where('no_barang', 'LIKE', "%{$request->search}%")
//         ->orWhere('name_barang', 'LIKE', "%{$request->search}%")->get();

//     return view('transaksi.penjualan.sales', [
//         'barangs' => $barangs,
//     ]);
// }
}