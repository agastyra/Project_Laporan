<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\jurnal_memorial;
use Illuminate\Http\Request;

class memorialcontroller extends Controller
{
    private $transactionNumber;

    public function index()
    {
        return view('jurnal.memorial.index');
    }

    public function create()
    {
        jurnal_memorial::where('is_display', false)->delete();
        $akuns = akun::where('is_header_account', false)
            ->orderBy('no_account', 'asc')->get();
        $date = date('Y-m-d'); #2008-11-11

        $noTransaksiPembelian = $this->setNewTransactionNumber();

        jurnal_memorial::create([
            'no_transaction' => $noTransaksiPembelian,
            'date' => $date,
        ]);

        return view('jurnal.memorial.memo', [
            'akuns' => $akuns,
            'date' => $date,
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function get_account_info($id)
    {
        $akun = akun::where('id', $id)->get();
        return response()->json($akun);
    }

    private function getTransactionId()
    {
        $noTransaksiPembelian = $this->getTransactionNumber();
        $result = jurnal_memorial::where('no_transaction', $noTransaksiPembelian)->get();

        $id = $result[0]->id;

        return $id;
    }

    private function getTransactionNumber()
    {
        $result = jurnal_memorial::latest()->value('no_transaction');

        return $result;
    }

    private function setNewTransactionNumber()
    {
        $noTransaksiPembelian = jurnal_memorial::latest()->value('no_transaction');

        if (is_null($noTransaksiPembelian)) {
            $this->transactionNumber = "JM-001";
        } else {
            $noTransaksiPembelian = explode('-', $noTransaksiPembelian);
            $prefix = $noTransaksiPembelian[0];
            $order = (int) $noTransaksiPembelian[1];
            $order++;
            $order = (string) $order;
            if (strlen($order) == 1) {
                $order = '0' . $order;
            }
            $this->transactionNumber = $prefix . '-' . $order;
        }

        return $this->transactionNumber;
    }
}
