<?php

namespace App\Http\Controllers;

use App\Models\akun;
use Illuminate\Http\Request;

class akunController extends Controller
{
    public function index()
    {
        $akuns = akun::orderBy('no_account', 'asc')->get();

        return view('akun.index', [
            'akuns' => $akuns,
        ]);
    }

    public function show(akun $akun)
    {
        return view('akun.show', [
            'akun' => $akun,
        ]);
    }
<<<<<<< HEAD
=======

    public function edit(akun $akun)
    {
        return view('akun.edit', [
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_account' => 'required|size:3|unique:akuns',
            'name_account' => 'required|max:100|unique:akuns',
            'is_header_account' => '',
            'header_account' => '',
            'balance' => '',
        ]);

        akun::create($validatedData);

        return redirect()->route('accounts');
    }

    public function update(Request $request, akun $akun)
    {
        $validatedData = $request->validate([
            'no_account' => 'required|size:3|unique:akuns',
            'name_account' => 'required|max:100|unique:akuns',
            'is_header_account' => '',
            'header_account' => '',
            'balance' => '',
        ]);

        akun::whereId($akun->id)->update($validatedData);

        return redirect()->route('accounts');
    }

    public function destroy(akun $akun)
    {
        akun::destroy($akun->id);

        return redirect()->route('accounts');
    }
>>>>>>> cbf5c9c9d4774734d2192155c0fc5da30c5474ae
}