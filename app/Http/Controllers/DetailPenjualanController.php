<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailStoreRequest;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\transaksi_penjualan;
use Illuminate\Support\Facades\DB;
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
    public function store(Request $request)
    {

        $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'))->first();
        if ($noTrans) {
            $tranCode = ((int) $noTrans->noTrans + date('dm'));
        } else {
            $tranCode = 1;
        }

        $goods = barang::where("id", $request->barang_id)->first();

        if ($goods <> null) {
            $stock = $goods->stok - (int) $request->qty;
            $goods->update(['stok' => $stock]);
        } else {
            return redirect()->back()->withErrors(['name_barang' => 'Barang not found']);
        }

        $details = detail_penjualan::where('no_transaction', $tranCode)->where('barang_id', $request->barang_id)->first();

        if ($details) {
            $sumQty = $details->qty + $request->qty;
            $sumSubTotal = $details->subTotal + $request->subTotal;

            $details->update(['qty' => $sumQty, 'subTotal' => $sumSubTotal]);
        } else {
            $detailStore = detail_penjualan::create([
                'no_transaction' => $tranCode,
                'barang_id' => $request->barang_id,
                'qty' => $request->qty,
                'subTotal' => $request->subTotal
            ]);
        }

        return redirect()->route('transaksi.create', $tranCode);

    }

    // if (!isset($barangId)) {
    //     return redirect()->back()->withErrors('Produk Tidak Ditemukan');
    // }

    // $details = detail_penjualan::where([
    //     ['no_transaction', '=', $tranCode],
    //     ['barang_id', '=', $barangId]
    // ])->get();

    // $subTotal = $qty * $barangPrice;
    // $reduceStock = $barangStock - $qty;

    // $stockReduce = [
    //     'stok' => $reduceStock
    // ];

    // $create = ([
    //     'barang_id' => $barangId,
    //     'no_transaction' => $tranCode,
    //     'harga_jual' => $barangPrice,
    //     'qty' => $qty,
    //     'subTotal' => $subTotal
    // ]);

    // if ($barangStock == 0) {
    //     return redirect()->back()->withErrors('Stok' . $barangName . 'Kosong');
    // }elseif ((int)$qty <= $barangStock) {
    //     if ($details->isEmpty()) {
    //         foreach ($details as $detail) {
    //             if ($detail->barangs_id == $barangId) {
    //                 $update = [
    //                     'qty' => $detail->qty + $qty,
    //                     'subTotal' => $detail->subTotal + $subTotal,
    //                 ];
    //                 detail_penjualan::findOrFail($detail->id)->update($update);
    //                 barang::findOrFail($barangId)->update($stockReduce);
    //             }else {
    //                 detail_penjualan::create($create);
    //                 barang::findOrFail($barangId)->update($stockReduce);
    //             }

    //         }
    //     }else {
    //         detail_penjualan::create($create);
    //         barang::findOrFail($barangId)->update($stockReduce);
    //     }
    //     return redirect()->route('transaksi.create', $tranCode);
    // }else{
    //     return redirect()->back();
    // }

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
        $detail = detail_penjualan::findOrFail($id);
        return view('transaksi.penjualan.edit', compact('detail'));
    }

    public function calcDetail(Request $request)
    {
        $harga_jual = $request->harga_jual;
        $qty = $request->qty;
        $subTotal = $harga_jual * $qty;

        return response()->json(['subTotal' => $subTotal]);
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
        $detail = detail_penjualan::find($id);

        if ($detail) {
            $barang = barang::find($detail->barang_id);

            if ($barang) {
                $stok = $barang->stok + $detail->qty - $request->qty;

                if ($stok < 0) {
                    return redirect()->back()->withErrors(['qty' => 'Stok tidak mencukupi']);
                }

                $barang->stok = $stok;
                $barang->save();

                $subTotal = $request->qty * $barang->harga_jual;

                $detail->qty = $request->qty;
                $detail->subTotal = $subTotal;
                $detail->save();
            }
        }

        return redirect()->route('transaksi.create', $detail->no_transaction);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = detail_penjualan::findOrFail($id);
        $detail->delete();
        return redirect()->route('transaksi.create', $detail->no_transaction)
            ->with('success', 'Detail penjualan berhasil dihapus');
    }


}