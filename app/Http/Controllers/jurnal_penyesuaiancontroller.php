<?php

namespace App\Http\Controllers;

use App\Models\jurnal_penyesuaian;
use Illuminate\Http\Request;

class jurnal_penyesuaiancontroller extends Controller
{
     public function index()

    {
        $dtpenyesuaian = jurnal_penyesuaian::all();

        return view('jurnal.penyesuaian.penyesuaian', [
            'jurnal_penyesuaians' => $dtpenyesuaian,
        ]);
    }

      public function create()
    {
        return view('jurnal.penyesuaian.create-penyesuaian');
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
       
        jurnal_penyesuaian::create([
            'date' => $request->date,
            'debet' => $request->debet,
            'kredit' => $request->kredit,
        ]);
        return redirect('penyesuaian');
    }
}