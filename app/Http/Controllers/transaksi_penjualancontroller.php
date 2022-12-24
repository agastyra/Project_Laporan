<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_penjualan;
use Illuminate\Support\Facades\DB;

class transaksi_penjualancontroller extends Controller
{

    public $nota;
    public function index()
    {
        $sales = DB::table('transaksi_penjualans')->select(DB::raw('MAX(id) as NSale'));
        if($sales->count() > 0){
            foreach($sales->get() as $key){
                $this->nota = ((int)$key->NSale + 1);
            }
        }else {
            $this->nota = 1;
        }

        $date = date('Y-m-d');
        $barang = barang::all();
        $detail = detail_penjualan::where('transaksi_penjualans_id', $this->nota)->get();
        return view("transaksi.penjualan.sales", [
            'date' => $date,
            'name_barang' => $barang,
            'detail' => $detail,
        ]);
    }
}
