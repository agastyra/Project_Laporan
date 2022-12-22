<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class barangcontroller extends Controller
{

    public function index()
    {
        $barangs = barang::all();
        return view('barang.index', [
            'barangs' => $barangs
        ]);
    }

    public function show(barang $barang)
    {
        return view();
    }

    public function edit(barang $barang)
    {
        return view();
    }

    public function store(Request $request)
    {

        $valid = $request->validate([
            'no_barang' => 'required|max:5|unique:barangs',
            'nama_barang' => 'required|max:30|unique:barangs',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required', 
        ]);
        barang::create($valid);

        return redirect()->route('');
    }

    public function update(Request $request, barang $barang)
    {
        $valid = $request->validate([
            'no_barang' => 'required|max:5|unique:barangs',
            'nama_barang' => 'required|max:30|unique:barangs',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required', 
        ]);
        barang::whereId($barang->id)->update($valid);

        return redirect()->route('');
    }

    public function destroy(barang $barang)
    {
        barang::destroy($barang->id);

        return redirect()->route('');
    }
}
