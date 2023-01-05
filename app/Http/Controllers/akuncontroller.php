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

    public function create()
    {
        $akun_headers = akun::where('is_header_account', true)->get();
        return view('akun.view', [
            'akun_headers' => $akun_headers,
        ]);
    }

    public function edit(akun $akun)
    {
        $akun_headers = akun::where('is_header_account', true)->get();
        return view('akun.edit', [
            'akun_headers' => $akun_headers,
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_account' => 'required|size:4|unique:akuns',
            'name_account' => 'required|max:100|unique:akuns',
            'is_header_account' => '',
            'header_account' => 'required_if:is_header_account,false',
            'type_account' => 'required',
            'balance' => '',
        ]);

        akun::create($validatedData);

        return redirect()->route('accounts');
    }

    public function update(Request $request, akun $akun)
    {
        $validatedData = $request->validate([
            'no_account' => 'required|size:4',
            'name_account' => 'required|max:100',
            'is_header_account' => '',
            'header_account' => 'required_if:is_header_account,false',
            'type_account' => 'required',
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
}
