<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\bukti_kas_keluar;
use App\Models\transaksi_pembelian;
use Illuminate\Http\Request;
use PDF;

class bukti_kas_keluarcontroller extends Controller
{
    private $transactionNumber;

    public function index()
    {
        $bukti_kas_keluars = bukti_kas_keluar::all();
        return view('BuktiKasKeluar.index', [
            'bukti_kas_keluars' => $bukti_kas_keluars,
        ]);
    }

    public function form()
    {
        $akuns = akun::where('is_header_account', false)
            ->where('type_account', '<>', 1)
            ->orderBy('no_account', 'asc')->get();
        $transaksis = transaksi_pembelian::where('is_display', true)->orderBy('no_transaction', 'asc')->get();
        $transactionNumber = $this->setNewTransactionNumber();

        return view('buktikaskeluar.form', [
            'akuns' => $akuns,
            'transaksis' => $transaksis,
            'transactionNumber' => $transactionNumber,
        ]);
    }

    public function save(Request $request)
    {
        $rules = [];

        if ($request->is_other) {
            $rules = [
                'is_other' => '',
                'tanggal' => 'required',
                'akun_id' => 'required',
                'akun_amount' => 'required|gt:0',
                'description' => 'required',
            ];
            $data = $request->validate($rules);
            $data['transaksi_pembelian_id'] = null;
            $data['no_transaction'] = $this->setNewTransactionNumber();
            bukti_kas_keluar::create($data);
        } else {
            $rules = [
                'is_other' => '',
                'tanggal' => 'required',
                'transaksi_pembelian_id' => 'required',
                'description' => 'required',
            ];
            $data = $request->validate($rules);
            $data["akun_id"] = null;
            $data["akun_amount"] = null;
            $data['no_transaction'] = $this->setNewTransactionNumber();
            bukti_kas_keluar::create($data);
        }

        return redirect()->route('cash_out');
    }

    public function get_transaction(transaksi_pembelian $transaksi_pembelian)
    {
        $vendor = '';

        if ($transaksi_pembelian->vendor == 1) {
            $vendor = 'Risky';
        } elseif ($transaksi_pembelian->vendor == 2) {
            $vendor = 'Muhlas';
        } elseif ($transaksi_pembelian->vendor == 3) {
            $vendor = 'Mukhlis';
        }

        $total = $transaksi_pembelian->grand_total;

        return response()->json([
            'vendor' => $vendor,
            'total' => $total,
        ]);
    }

    public function report(bukti_kas_keluar $bukti_kas_keluar)
    {
        $pdf = PDF::loadView('BuktiKasKeluar.report', [
            'bkk' => $bukti_kas_keluar,
        ]);

        return $pdf->stream();
    }

    private function setNewTransactionNumber()
    {
        $noTransaksiPembelian = bukti_kas_keluar::latest()->value('no_transaction');

        if (is_null($noTransaksiPembelian)) {
            $this->transactionNumber = "BKK-01";
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
