<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class barangcontroller extends Controller
{

    private $inc;
    public function index()
    {
        $barangs = barang::all();
        return view('barang.index', [
            'barangs' => $barangs,
        ]);
    }

    public function create()
    {
        $tambah = barang::where('no_barang', true)->get();
        return view('barang.barang', [
            'tambah' => $tambah,
        ]);
    }

    public function edit(barang $barang)
    {
        $rubah = barang::where('no_barang', $barang->no_barang)->get();
    }

    public function store(Request $request)
    {

        $valid = $request->validate([
            'no_barang' => 'required|max:6|unique:barangs',
            'nama_barang' => 'required|max:30|unique:barangs',
            'stok' => 'required|integer|gte:0',
            'harga_beli' => 'required|numeric|gte:0',
            'harga_jual' => 'required|numeric|gte:0',
        ]);
        barang::create($valid);

        return redirect()->route('barang');
    }

    public function update(Request $request, barang $barang)
    {
        $valid = $request->validate([
            'no_barang' => 'required|max:6|unique:barangs',
            'nama_barang' => 'required|max:30|unique:barangs',
            'stok' => 'required|integer|gte:0',
            'harga_beli' => 'required|numeric|gte:0',
            'harga_jual' => 'required|numeric|gte:0',
        ]);
        barang::whereId($barang->id)->update($valid);

        return redirect()->route('');
    }

    public function destroy(barang $barang)
    {
        barang::destroy($barang->id);

        return redirect()->route('barang');
    }

    private function incrementid()
    {
        $no_barang = barang::latest()->value('no_barang');

        if (is_null($no_barang)) {
            $this->inc = "BRG-01";
        } else {
            $nobarang = explode('-', $no_barang);
            $prefix = $nobarang[0];
            $order = (int) $nobarang[1];
            $order++;
            $order = (string) $order;
            if (strlen($order) == 1) {
                $order = '0' . $order;
            }
            $this->inc = $prefix . '-' . $order;
        }

        return $this->inc;
    }
}
