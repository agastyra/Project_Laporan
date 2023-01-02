<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailStoreRequest;
use App\Http\Requests\TranSaleRequest;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class transaksi_penjualancontroller extends Controller
{

    public $nota;
    public function index()
    {
        // $sales = DB::table('transaksi_penjualans')->select(DB::raw('MAX(id) as NSale'));
        // if ($sales->count() > 0) {
        //     foreach ($sales->get() as $key) {
        //         $this->nota = ((int) $key->NSale + 1);
        //     }
        // } else {
        //     $this->nota = 1;
        // }

        // $date = date('Y-m-d');
        // $barangs = barang::all();
        // $detail = detail_penjualan::where('transaksi_penjualans_id', $this->nota)->get();

        // if ($detail->count() > 0) {
        //     $total = DB::table('detail_penjualans')->select(DB::raw('SUM(subTotal) as grand_total'))
        //         ->where('transaksi_penjualans_id', $this->nota)->groupBy('transaksi_penjualans_id')->first();
        //     $grandTotal = $total->grand_total;
        // }
        // return view("transaksi.penjualan.sales", [
        //     'barangs' => $barangs,
        //     'date' => $date,
        //     'detail' => $detail,
        //     // 'grand_total' => $grandTotal,
        // ]);

       // return view("transaksi.penjualan.sales");
    }

    public function create($transaksiId)
    {
        if (is_null($transaksiId)) {
            abort(404);
        }

        $details = detail_penjualan::with([
            'barangs_id'
        ])->where('transaksi_penjualans_id', $transaksiId);

        $items = $details->get();
        $subTotal = $details->sum('subTotal');

        return view('transaksi.penjualan.sales', [
            'transaksiId' => $transaksiId,
            'items' => $items,
            'subTotal' => $subTotal
        ]);
    }

    public function store(TranSaleRequest $request)
    {
        $request = $request->all();

        $data['grand_total'] = str_replace(',', '', $request['grand_total']);
        $data['bayar'] = str_replace(',', '', $request['bayar']);
        $data['kembali'] = str_replace(',', '', $request['kembali']);

        $transaksiId = now()->format('dmy') . transaksi_penjualan::all()->count();

        transaksi_penjualan::where('no_transaction', $request['no_transaction'])
            ->update($data);

        return redirect()->route('transaksi.create');

    }

    public function search(Request $request)
    {
        // $keyword = $request->input('keyword');
        // $barangs = collect([]);
        // if ($keyword) {
        //     $barangs = barang::query()
        //         ->where('no_barang', 'like', "%{$keyword}%")
        //         ->orWhere('name_barang', 'like', "%{$keyword}%")->get();
        // }

        // return view('transaksi.penjualan.sales', compact('barangs'));
    }

    // public function storeDetail(DetailStoreRequest $request)
    // {
    //     $input = $request->all();

    //     $transaksiId = $input['no_transaction'];
    //     $qty = $input['qty'];

    //     transaksi_penjualan::firstOrCreate([
    //         'no_transaction' => $transaksiId,
    //     ]);

    //     $barangs = barang::where('no_barang', $input['no_barang'])->get();
    //     foreach ($barangs as $barang) {
    //         $barangId = $barang->id;
    //         $barangName = $barang->name_barang;
    //         $barangPrice = $barang->harga_jual;
    //         $barangStock = $barang->stok;
    //     }

    //     if (isset($barangId)) {
    //         return redirect()->back()->withErrors('Produk Tidak Ditemukan');
    //     }

    //     $details = detail_penjualan::where([
    //         ['transaksi_penjualans_id', '=', $transaksiId],
    //         ['barangs_id', '=', $barangId]
    //     ])->get();

    //     $subTotal = $qty * $barangPrice;
    //     $reduceStock = $barangStock - $qty;

    //     $stockReduce = [
    //         'stok' => $reduceStock
    //     ];

    //     $create = ([
    //         'barangs_id' => $barangId,
    //         'transaksi_penjualan_id' => $transaksiId,
    //         'qty' => $qty,
    //         'subTotal' => $subTotal
    //     ]);

    //     if ($barangStock == 0) {
    //         return redirect()->back()->withErrors('Stok' . $barangName . 'Kosong');
    //     }elseif ((int)$qty <= $barangStock) {
    //         if ($details->isEmpty()) {
    //             foreach ($details as $detail) {
    //                 if ($detail->barangs_id == $barangId) {
    //                     $update = [
    //                         'qty' => $detail->qty + $qty,
    //                         'subTotal' => $detail->subTotal + $subTotal,
    //                     ];
    //                     detail_penjualan::findOrFail($detail->id)->update($update);
    //                     barang::findOrFail($barangId)->update($stockReduce);
    //                 }else {
    //                     detail_penjualan::create($create);
    //                     barang::findOrFail($barangId)->update($stockReduce);
    //                 }
                    
    //             }
    //         }else {
    //             detail_penjualan::create($create);
    //             barang::findOrFail($barangId)->update($stockReduce);
    //         }
    //         return redirect()->route('transaksi.create', $transaksiId);
    //     }else{
    //         return redirect()->back();
    //     }

       

        

    //     // $sales = DB::table('transaksi_penjualans')->select(DB::raw('MAX(id) as num'));
    //     // if ($sales->count() > 0) {
    //     //     foreach ($sales->get() as $key) {
    //     //         $no = ((int) $key->num + 1);
    //     //     }
    //     // }else {
    //     //     $no = 1;
    //     // }

        

        
    // }

    // public function updateDetail(Request $request, $id)
    // {
    //     $input = $request->all();

    //     $id = $id;

    //     $transaksiId = $input['no_transaction'];
    //     $qty = $input['qty'];

    //     $valid = Validator::make($input, [
    //         'no_transaction' => 'required',
    //         'qty' => 'required'
    //     ]);

    //     if ($valid->fails()) {
    //         return redirect()->route('transaksi.create', $transaksiId)
    //             ->withErrors($valid)
    //             ->withInput();
    //     }

    //     $details = detail_penjualan::find($id);
    //     $stockSale = $details->qty;
    //     $barangId = $details->barangs_id;

    //     $barangs = barang::findOrFail($barangId);
    //     $barangPrice = $barangs->harga_jual;
    //     $barangStock = $barangs->stok;

    //     $firstStock = $barangStock + $stockSale;
    //     $stockReduce = $firstStock - $qty;
    //     $total = $qty * $barangPrice;

    //     if ((int)$qty < $firstStock) {
    //         detail_penjualan::findOrFail($id)->update([
    //             'qty' => $qty,
    //             'subTotal' => $total
    //         ]);
    //         barang::findOrFail($barangId)->update([
    //             'stok' => $stockReduce
    //         ]);
    //         return redirect()->route('transaksi.create');
    //     }else {
    //         return redirect()->back()->withErrors('Stok tidak mencukupi');
    //     }
    // }

    // public function destroy($id)
    // {
    //     $details = detail_penjualan::findOrFail($id);
    //     $stockSale = $details->qty;
    //     $barangId = $details->barangs_id;

    //     $barangStock = barang::findOrFail($barangId)->stok;
    //     $firstStock = $barangStock + $stockSale;

    //     barang::findOrFail($barangId)->update([
    //         'stok' => $firstStock
    //     ]);

    //     detail_penjualan::findOrFail($id)->delete();
    //     return redirect()->back();
    // }
}