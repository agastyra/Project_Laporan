<?php

namespace App\Http\Controllers;

use App\Models\akun;
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
        $akun = akun::all();
        // $akuns = akun::orderBy('no_account', 'asc')->get();
        return view('jurnal.penyesuaian.create-penyesuaian', [
            'akun' => $akun,
        ]);
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
    //  public function edit()
    // {
    //     return view('jurnal.penyesuaian.edit-penyesuaian');
    // }
    /** 
    * Show the form for editing the specified resource.
    */
        
    // public function edit($id)
    // {
    //     $peny = jurnal_penyesuaian::findorfail($id);
    //     return view('junal.penyesuaian.edit-penyesuaian',compact('penye'));
    // }
    public function edit(jurnal_penyesuaian $id)
    {
        $akun = akun::all();

        $penye= jurnal_penyesuaian::where('kredit', true)->get();
        return view('jurnal.penyesuaian.editt-penyesuaian', [
            'penye' => $penye,
            'id' => $id,
            'akun' => $akun,
        ]);
    }

    public function update(Request $request, $id)
    {
        $penye = jurnal_penyesuaian::findorfail($id);
    //     if ($request->debit) {
    //     $penye->debit = $request->debit;
    //     $penye->kredit = 0;
    // } elseif ($request->B) {
    //     $penye->kredit = $request->kredit;
    //     $penye->debit = 0;
    // }
    // $penye->save();
        $penye->update($request->all());
        return redirect('penyesuaian')->with('toast_success', 'Data Berhasil Update');

    }
    //      public function update(Request $request, jurnal_penyesuaian $penye)
    // {
    //     $validatedData = $request->validate([
    //         'date' => 'required|size:8',
    //         'debet' => '',
    //         'kredit' => 'required_if:debet,false',
           
    //     ]);

    //     jurnal_penyesuaian::whereId($penye->id)->update($validatedData);

    //     return redirect()->route('penyesuaian');
    // }
     public function destroy($id)
     {
         $penye = jurnal_penyesuaian::findorfail($id);
         $penye->delete();
         return redirect()->route('penyesuaian');
        // return back();
     }

}