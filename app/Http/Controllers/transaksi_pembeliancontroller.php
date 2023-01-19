<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_pembelian;
use App\Models\transaksi_pembelian;
use Illuminate\Http\Request;

class transaksi_pembeliancontroller extends Controller
{
    private $transactionNumber;

    public function index()
    {
        return view('transaksi.pembelian.index');
    }

    public function create()
    {
        $barangs = barang::orderBy('no_barang', 'asc')->get();

        $date = date('Y-m-d'); #2008-11-11

        $noTransaksiPembelian = $this->setNewTransactionNumber();

        // dd($noTransaksiPembelian . ' ' . $date);

        transaksi_pembelian::create([
            'no_transaction' => $noTransaksiPembelian,
            'date' => $date,
        ]);

        return view('transaksi.pembelian.purch', [
            'barangs' => $barangs,
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function cari_barang(barang $barang)
    {
        $result = barang::where('no_barang', $barang->no_barang)->get();

        return response()->json(['result' => $result]);
    }

    public function get_detail()
    {
        $idTransaksiPembelian = $this->getTransactionId();

        $result = transaksi_pembelian::join('detail_pembelians', 'transaksi_pembelians.id', '=', 'detail_pembelians.transaksi_pembelians_id')
            ->join('barangs', 'detail_pembelians.barangs_id', '=', 'barangs.id')
            ->select('transaksi_pembelians.id',
                'transaksi_pembelians.no_transaction',
                'barangs.id',
                'barangs.no_barang',
                'barangs.name_barang',
                'barangs.harga_beli',
                'detail_pembelians.qty'
            )
            ->where('transaksi_pembelians.id', $idTransaksiPembelian)
            ->get();

        return response()->json(['result' => $result]);
    }

    public function store_detail(Request $request)
    {
        $idTransaksiPembelian = $this->getTransactionId();
        $barangs_id = $request->barangs_id;
        $qty = $request->validate([
            'qty' => 'required',
        ]);

        $data = [
            'transaksi_pembelians_id' => $idTransaksiPembelian,
            'barangs_id' => $barangs_id,
            'qty' => $qty['qty'],
        ];

        detail_pembelian::create($data);
    }

    private function getTransactionId()
    {
        $noTransaksiPembelian = $this->getTransactionNumber();
        $result = transaksi_pembelian::where('no_transaction', $noTransaksiPembelian)->get();

        $id = $result[0]->id;

        return $id;
    }

    private function getTransactionNumber()
    {
        $result = transaksi_pembelian::latest()->value('no_transaction');

        return $result;
    }

    private function setNewTransactionNumber()
    {
        $noTransaksiPembelian = transaksi_pembelian::latest()->value('no_transaction');

        if (is_null($noTransaksiPembelian)) {
            $this->transactionNumber = "TRX-01";
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
