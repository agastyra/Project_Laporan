<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transaksi_penjualancontroller extends Controller
{

    public $nota;
    public $data = [];
    public function index()
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

        if ($detail->count() > 0) {
            $total = DB::table('detail_penjualans')->select(DB::raw('SUM(subTotal) as grand_total'))
                ->where('transaksi_penjualans_id', $this->nota)->groupBy('transaksi_penjualans_id')->first();
            $grandTotal = $total->grand_total;
        }
        return view("transaksi.penjualan.sales", [
            'barangs' => $barangs,
            'date' => $date,
            'detail' => $detail,
            'grand_total' => $grandTotal,
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

    public function storeDetail(Request $request)
    {
        $sales = DB::table('transaksi_penjualans')->select(DB::raw('MAX(id) as num'));
        if ($sales->count() > 0) {
            foreach ($sales->get() as $key) {
                $no = ((int) $key->num + 1);
            }
        }else {
            $no = 1;
        }

        // $barangs = barang::all();

        $details = DB::table('detail_penjualans')->where('transaksi_penjualans_id', $no)->where('barangs_id', $this->data['name_barang'])->first();

        if ($details) {
           $valid = $request->validate($this->data, [
                'name_barang' => 'required|max:30|unique:barangs',
                'harga_jual' => 'required',
                'qty' => 'required',
                'subTotal' => 'required',
            ]);

            $qtyTotal = $details->qty + $this->data['qty'];
            $totalSub = $details->subTotal + $this->data['subTotal'];

            DB::table('detail_penjualans')->where('transaksi_penjualans_id', $no)->where('barangs_id', $this->data['name_barang'])
                ->update(['qty' => $qtyTotal, 'subTotal' => $totalSub]);
        }else {
            $valid = $request->validate($this->data, [
                'name_barang' => 'required|max:30|unique:barangs',
                'harga_jual' => 'required',
                'qty' => 'required',
                'subTotal' => 'required',
            ]);

            detail_penjualan::create([
                'transaksi_penjualans_id' => $no,
                'barangs_id' => $this->data['name_barang'],
                'qty' => $this->data['qty'],
                'subTotal' => $this->data['subTotal'],
            ]);
        }
    }
}