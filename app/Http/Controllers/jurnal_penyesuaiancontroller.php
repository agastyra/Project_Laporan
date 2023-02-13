<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\jurnal_penyesuaian;
use App\Models\jurnal_penyesuaian_detail;
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
            'total_debet' => $request->total_debet,
            'total_kredit' => $request->total_kredit,
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
         $penye = jurnal_penyesuaian_detail::findorfail($id);
         $penye->delete();
         return redirect()->route('penyesuaian');
        // return back();
     }

     //untuk penyesuaian_detail
      public function index_detail()

    {
        $dtpenyesuaian_detail = jurnal_penyesuaian_detail::all();

        return view('jurnal.penyesuaian_detail.penyesuaian_detail', [
            'jurnal_penyesuaians_details' => $dtpenyesuaian_detail,
        ]);
    }
      public function create_detail()
    {
        // $akun = akun::all();
        // $akuns = akun::orderBy('no_account', 'asc')->get();
        return view('jurnal.penyesuaian.penyesuaian_detail', [
            // 'akun' => $akun,
        ]);
    }
    public function store_detail(Request $request)
    {
        dd($request->toArray());
       
        // jurnal_penyesuaian_detail::create([

        //     'jurnal_penyesuaians_id' => $request->jurnal_penyesuaians_id,
        //     'akuns_id' => $request->akuns_id,
        //     'debet' => $request->debet,
        //     'kredit' => $request->kredit,
        // ]);
        return redirect('simpan_penyesuaian_detail');
    }
//     public function getPenyesuaianId($id)
// {
//     $penyesuaian_detail = jurnal_penyesuaian_detail::find($id);
//     $penyesuaians_id = $penyesuaian_detail->penyesuaian->id;

//     return $penyesuaians_id;
// }


}