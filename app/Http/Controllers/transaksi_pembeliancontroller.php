<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_pembelian;
use App\Models\transaksi_pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transaksi_pembeliancontroller extends Controller
{
    private $transactionNumber;

    public function index()
    {
        $purchases = transaksi_pembelian::where('is_display', true)->get();

        return view('transaksi.pembelian.index', [
            'purchases' => $purchases,
        ]);
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
        $idTransaksiPembelian = $this->getTransactionId();
        transaksi_pembelian::where('id', $idTransaksiPembelian)
            ->update([
                'vendor' => $request->vendor,
                'grand_total' => $request->grand_total,
                'diskon' => $request->diskon,
                'bayar' => $request->bayar,
                'kembali' => $request->kembali,
                'is_display' => true,
            ]);
        return redirect()->route('purchase')->with('success', 'Berhasil membeli barang');
    }

    public function cari_barang(barang $barang)
    {
        $result = barang::where('no_barang', $barang->no_barang)->get();

        return response()->json(['result' => $result]);
    }

    public function validate_barang(barang $barang)
    {
        $idTransaksiPembelian = $this->getTransactionId();

        $barang_exists = detail_pembelian::select(DB::raw('barangs_id, count(barangs_id) as jml_barang, transaksi_pembelians_id'))
            ->where('barangs_id', $barang->id)
            ->where('transaksi_pembelians_id', $idTransaksiPembelian)
            ->groupBy('barangs_id')
            ->groupBy('transaksi_pembelians_id')
            ->get();

        return response()->json($barang_exists);
    }

    public function get_detail()
    {
        $idTransaksiPembelian = $this->getTransactionId();

        $result = transaksi_pembelian::join('detail_pembelians', 'transaksi_pembelians.id', '=', 'detail_pembelians.transaksi_pembelians_id')
            ->join('barangs', 'detail_pembelians.barangs_id', '=', 'barangs.id')
            ->select('transaksi_pembelians.id as trx_id',
                'transaksi_pembelians.no_transaction',
                'detail_pembelians.id as detail_id',
                'barangs.id as brg_id',
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
            'qty' => 'required|gt:0',
        ]);

        $data = [
            'transaksi_pembelians_id' => $idTransaksiPembelian,
            'barangs_id' => $barangs_id,
            'qty' => $qty['qty'],
        ];

        detail_pembelian::create($data);
    }

    public function update_detail(Request $request)
    {
        $idTransaksiPembelian = $this->getTransactionId();
        $barangs_id = $request->barangs_id;
        $barang = barang::where('id', $barangs_id)->first();

        $qty = $request->validate([
            'qty' => 'required|gt:0',
        ]);

        $barang_qty = detail_pembelian::where('barangs_id', $barang->id)
            ->where('transaksi_pembelians_id', $idTransaksiPembelian)
            ->value('qty');

        detail_pembelian::where('barangs_id', $barang->id)
            ->where('transaksi_pembelians_id', $idTransaksiPembelian)
            ->update([
                'qty' => $barang_qty + $qty['qty'],
            ]);

        $detail = detail_pembelian::where('barangs_id', $barang->id)
            ->where('transaksi_pembelians_id', $idTransaksiPembelian)
            ->first();

        return response()->json([
            'barang' => $barang,
            'detail' => $detail,
        ]);
    }

    public function update_detail_qty(Request $request)
    {
        $barang = barang::where('id', $request->barangs_id)->first();
        $detail = detail_pembelian::where('barangs_id', $barang->id)
            ->where('transaksi_pembelians_id', $request->transaksi_pembelians_id)
            ->first();

        detail_pembelian::where('transaksi_pembelians_id', $request->transaksi_pembelians_id)
            ->where('barangs_id', $request->barangs_id)
            ->update([
                'qty' => $request->qty,
            ]);

        return response()->json([
            'barang' => $barang,
            'detail' => $detail,
        ]);

    }

    public function delete_detail(Request $request)
    {
        $detail_id = detail_pembelian::where('barangs_id', $request->barangs_id)
            ->where('transaksi_pembelians_id', $request->transaksi_pembelians_id)
            ->value('id');

        detail_pembelian::destroy($detail_id);
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
