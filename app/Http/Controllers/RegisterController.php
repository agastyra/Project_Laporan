<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $userNumber = '';

    public function index()
    {
        $api = new APIController();

        $provinsis = $api->get_provinsi();

        return view('auth.register', [
            'provinsis' => $provinsis['provinsi'],
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:6|max:20|unique:users',
            'password' => 'required|min:8|max:16',
            'nama_depan' => 'required|max:20',
            'nama_belakang' => 'required|max:20',
            'jenis_kelamin' => 'required',
            'ttl' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'alamat_jalan' => 'required|max:100',
            'alamat_provinsi' => 'required',
            'alamat_kota_kabupaten' => 'required',
            'alamat_kecamatan' => 'required',
            'alamat_kelurahan' => 'required',
            'alamat_kode_pos' => 'required|size:5'
        ]); 

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
    }

    private function setNewNoUser()
    {
        $noUser = User::latest()->value('no_user');

        if (is_null($noUser)) {
            $this->userNumber = "TRX-01";
        } else {
            $noUser = explode('-', $noUser);
            $prefix = $noUser[0];
            $order = (int) $noUser[1];
            $order++;
            $order = (string) $order;
            if (strlen($order) == 1) {
                $order = '0' . $order;
            }
            $this->userNumber = $prefix . '-' . $order;
        }

        return $this->userNumber;
    }
}
