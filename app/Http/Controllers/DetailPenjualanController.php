<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailStoreRequest;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailStoreRequest $request)
    {
        $input = $request->all();

        $transaksiId = $input['no_transaction'];
        $qty = $input['qty'];

        transaksi_penjualan::firstOrCreate(['no_transaction' => $transaksiId], ['valid' => false]);

        $barangs = barang::where('no_barang', $input['no_barang'])->get();
        foreach ($barangs as $barang) {
            $barangId = $barang->id;
            $barangName = $barang->name_barang;
            $barangPrice = $barang->harga_jual;
            $barangStock = $barang->stok;
        }

        if (isset($barangId)) {
            return redirect()->back()->withErrors('Produk Tidak Ditemukan');
        }

        $details = detail_penjualan::where([
            ['no_transaction', '=', $transaksiId],
            ['barangs_id', '=', $barangId]
        ])->get();

        $subTotal = $qty * $barangPrice;
        $reduceStock = $barangStock - $qty;

        $stockReduce = [
            'stok' => $reduceStock
        ];

        $create = ([
            'barangs_id' => $barangId,
            'no_transaction' => $transaksiId,
            'harga_jual' => $barangPrice,
            'qty' => $qty,
            'subTotal' => $subTotal
        ]);

        if ($barangStock == 0) {
            return redirect()->back()->withErrors('Stok' . $barangName . 'Kosong');
        }elseif ((int)$qty <= $barangStock) {
            if ($details->isEmpty()) {
                foreach ($details as $detail) {
                    if ($detail->barangs_id == $barangId) {
                        $update = [
                            'qty' => $detail->qty + $qty,
                            'subTotal' => $detail->subTotal + $subTotal,
                        ];
                        detail_penjualan::findOrFail($detail->id)->update($update);
                        barang::findOrFail($barangId)->update($stockReduce);
                    }else {
                        detail_penjualan::create($create);
                        barang::findOrFail($barangId)->update($stockReduce);
                    }
                    
                }
            }else {
                detail_penjualan::create($create);
                barang::findOrFail($barangId)->update($stockReduce);
            }
            return redirect()->route('transaksi.create', $transaksiId);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $id = $id;

        $transaksiId = $input['no_transaction'];
        $qty = $input['qty'];

        $valid = Validator::make($input, [
            'no_transaction' => 'required',
            'qty' => 'required'
        ]);

        if ($valid->fails()) {
            return redirect()->route('transaksi.create', $transaksiId)
                ->withErrors($valid)
                ->withInput();
        }

        $details = detail_penjualan::find($id);
        $stockSale = $details->qty;
        $barangId = $details->barangs_id;

        $barangs = barang::findOrFail($barangId);
        $barangPrice = $barangs->harga_jual;
        $barangStock = $barangs->stok;

        $firstStock = $barangStock + $stockSale;
        $stockReduce = $firstStock - $qty;
        $total = $qty * $barangPrice;

        if ((int)$qty < $firstStock) {
            detail_penjualan::findOrFail($id)->update([
                'qty' => $qty,
                'subTotal' => $total
            ]);
            barang::findOrFail($barangId)->update([
                'stok' => $stockReduce
            ]);
            return redirect()->route('transaksi.create', $transaksiId);
        }else {
            return redirect()->back()->withErrors('Stok tidak mencukupi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $details = detail_penjualan::findOrFail($id);
        $stockSale = $details->qty;
        $barangId = $details->barangs_id;

        $barangStock = barang::findOrFail($barangId)->stok;
        $firstStock = $barangStock + $stockSale;

        barang::findOrFail($barangId)->update([
            'stok' => $firstStock
        ]);

        detail_penjualan::findOrFail($id)->delete();
        return redirect()->back();
    }
}
