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
        // $validatedData = $request->validate([
        //     'name_barang' => 'required',
        //     'harga_jual' => 'required',
        //     'qty' => 'required',
        //     'subTotal' => 'required'
        // ]);
        
    
        $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'))->first();
        if ($noTrans) {
            $tranCode = date('dmY') . ((int) $noTrans->noTrans + 1);
        } else {
            $tranCode =  1;
        }

        
        // dd($request->barang_id);
   
        // $goods = barang::findOrFail($request->name_barang);
        $goods = barang::where("id", $request->barang_id)->first();
        
        // dd($request->qty);
        if ($goods<> null) {
            $stock = $goods->stok - (int) $request->qty;
            $goods->update(['stok' => $stock]);
        } else {
            return redirect()->back()->withErrors(['name_barang' => 'Barang not found']);
        }

        // dd($goods);

        $details = detail_penjualan::where('no_transaction', $tranCode)->where('barang_id', $request->barang_id)->first();

        // dd("tes");
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
        // $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'));
        // if ($noTrans->count() > 0) {
        //     foreach($noTrans->get() as $pKey){
        //         $tranCode = now()->format('dmyHis') . ((int) $pKey->noTrans + 1);
        //     }
        // }else{
        //     $tranCode = 1;
        // }

        // $details = DB::table('detail_penjualans')->where('no_transaction', $tranCode)->where('barang_id', $request['name_barang'])->first();
        
        // if ($details) {
        //         Validator::make($request->all(),[
        //         'name_barang' => 'required',
        //         'harga_jual' => 'required',
        //         'qty' => 'required',
        //         'subTotal' => 'required'
        //     ])->validate();

        //     $sumQty = $details->qty + $request['qty'];
        //     $sumSubTotal = $details->subTotal + $request['subTotal'];

        //     DB::table('detail_penjualans')->where('no_transaction', $tranCode)->where('barang_id', $request['name_barang'])
        //         ->update(['qty' => $sumQty, 'subTotal' => $sumSubTotal]);
        // }else {
        //     Validator::make($request->all(),[
        //         'name_barang' => 'required',
        //         'harga_jual' => 'required',
        //         'qty' => 'required',
        //         'subTotal' => 'required'
        //     ])->validate();

        //    $detailStore = detail_penjualan::create([
        //         'no_transaction' => $tranCode,
        //         'barang_id' => $request['name_barang'],
        //         'qty' => $request['qty'],
        //         'subTotal' => $request['subTotal']
        //     ]);
        // }

        // $goods = barang::findOrfail($request['name_barang']);
        // if ($goods) {
        //     $stock = $goods->stok - (int) $request['qty'];

        //     $goods->update(['stok' => $stock]);
        // }
        
        // if($detailStore){
        //     return redirect()->route('transaksi.create');
        // }else{
        //     return redirect()->route('transaksi.index');
        // }
        
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

        $noTrans = DB::table('transaksi_penjualans')->select(DB::raw('MAX(no_transaction) as noTrans'));
        if ($noTrans->count() > 0) {
            foreach($noTrans->get() as $pKey){
                $tranCode = now()->format('dmyHis') . ((int) $pKey->noTrans + 1);
            }
        }else{
            $tranCode = 1;
        }
        $qty = $input['qty'];

        $valid = Validator::make($input, [
            'no_transaction' => 'required',
            'qty' => 'required'
        ]);

        if ($valid->fails()) {
            return redirect()->route('transaksi.create', $tranCode)
                ->withErrors($valid)
                ->withInput();
        }

        $details = detail_penjualan::findOrFail($id);
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
            return redirect()->route('transaksi.create', $tranCode);
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
