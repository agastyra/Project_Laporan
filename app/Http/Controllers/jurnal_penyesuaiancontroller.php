<?php

namespace App\Http\Controllers;

use App\Models\jurnal_penyesuaian;
use Illuminate\Http\Request;
use PhpParser\Node\Param;

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
     public function edit()
    {
        return view('jurnal.penyesuaian.edit-penyesuaian');
    }
    /** 
    * Show the form for editing the specified resource.
    */
        
    // public function edit($id)
    // {
    //     $peny = jurnal_penyesuaian::findorfail($id);
    //     return view('junal.penyesuaian.edit-penyesuaian',compact('penye'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $peny = jurnal_penyesuaian::findorfail($id);
    //     $peny->update($request->all());
    //     return redirect('penyesuaian')->with('toast_success', 'Data Berhasil Update');

    // }

}