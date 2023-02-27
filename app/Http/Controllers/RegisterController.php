<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $no_user = '';

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
            'no_user' => '',
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
            'alamat_kode_pos' => 'required|size:5',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        # 32120031912001
        $noUser = User::latest()->value('no_user');

        if (is_null($noUser)) {
            $tahun_lahir = explode('-', $validatedData['ttl']);
            $tahun_lahir = "$tahun_lahir[2]$tahun_lahir[1]$tahun_lahir[0]";
            $jenis_kelamin = $validatedData['jenis_kelamin'];
            $jabatan = $validatedData['jabatan'];
            $status = $validatedData['status'];
            $this->no_user = "$jabatan$status$jenis_kelamin$tahun_lahir/" . "001";
        } else {
            $noUser = explode('/', $noUser);
            $prefix = $noUser[0];
            $order = (int) $noUser[1];
            $order++;
            $order = (string) $order;
            if (strlen($order) == 1) {
                $order = '00' . $order;
            }
            $this->no_user = $prefix . '/' . $order;
        }

        $validatedData['no_user'] = $this->no_user;

        User::create($validatedData);

        return redirect()->route('/login', ['success' => 'Data anda berhasil di tambahkan!']);

    }
}
