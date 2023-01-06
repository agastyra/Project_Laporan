<?php

namespace App\Http\Controllers;

use App\Models\jurnal_penyesuaian;
use Illuminate\Http\Request;

class jurnal_penyesuaiancontroller extends Controller
{
     public function index()

    {
        $jurnal_penyesuaians = jurnal_penyesuaian::all();

        return view('jurnal.penyesuaian.penyesuaian', [
            'jurnal_penyesuaians' => $jurnal_penyesuaians,
        ]);
    }

      public function create()
    {
        return view('jurnal.penyesuaian.create-penyesuaian');
    }

    public function store(Request $request)
    {
        // 
        jurnal_penyesuaian::create([
            'tgl' => $request->tgl,
            'debet' => $request->debet,
            'kredit' => $request->kredit,
        ]);

        return redirect('penyesuaian');
    }
}