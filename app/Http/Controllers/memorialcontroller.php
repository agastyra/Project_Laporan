<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\jurnal_memorial;
use App\Models\jurnal_memorial_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class memorialcontroller extends Controller
{
    private $transactionNumber;

    public function index()
    {
        $jurnal_memorials = jurnal_memorial::where('is_display', true)->get();
        return view('jurnal.memorial.index', [
            'jurnal_memorials' => $jurnal_memorials,
        ]);
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
            'no_transaction' => $noTransaksiPembelian,
        ]);
    }

    public function detail(jurnal_memorial $jurnal_memorial)
    {
        $jurnal_memorials = jurnal_memorial::whereId($jurnal_memorial->id)->get();

        return view('jurnal.memorial.detail', [
            'jurnal_memorials' => $jurnal_memorials,
        ]);
    }

    public function store(Request $request)
    {
        $idJurnalMemorial = $this->getTransactionId();
        jurnal_memorial::where('id', $idJurnalMemorial)
            ->update([
                'is_display' => $request->is_display,
            ]);

        return response()->json([
            'status' => 'Jurnal memorial berhasil di tambahkan',
        ]);
    }

    public function destroy(jurnal_memorial $jurnal_memorial)
    {
        jurnal_memorial::destroy($jurnal_memorial->id);
        return redirect()->route('delete_memorial');
    }

    public function validate_akun(akun $akun)
    {
        $idTransaction = $this->getTransactionId();

        $akun_exists = jurnal_memorial_detail::select(DB::raw('akun_id, count(akun_id) as jml_akun, jurnal_memorial_id'))
            ->where('akun_id', $akun->id)
            ->where('jurnal_memorial_id', $idTransaction)
            ->groupBy('akun_id')
            ->groupBy('jurnal_memorial_id')
            ->get();

        return response()->json($akun_exists);
    }

    public function get_detail()
    {
        $transactionId = $this->getTransactionId();

        $detail = jurnal_memorial::join('jurnal_memorial_details', 'jurnal_memorials.id', '=', 'jurnal_memorial_details.jurnal_memorial_id')
            ->join('akuns', 'akuns.id', '=', 'jurnal_memorial_details.akun_id')
            ->select(
                'jurnal_memorials.id as jm_id',
                'jurnal_memorial_details.id as jmd_id',
                'akuns.id as akun_id',
                'akuns.no_account as no_akun',
                'akuns.name_account as name_akun',
                'jurnal_memorial_details.debet as debet',
                'jurnal_memorial_details.kredit as kredit'
            )
            ->where('jurnal_memorials.id', $transactionId)->get();

        return response()->json([
            'detail' => $detail,
        ]);
    }

    public function store_detail(Request $request)
    {
        $rules = [
            'akun_id' => 'required',
            'debet' => 'required|gte:0',
            'kredit' => 'required|gte:0',
        ];

        $data = $request->validate($rules);
        $data['jurnal_memorial_id'] = $this->getTransactionId();

        jurnal_memorial_detail::create($data);
    }

    public function update_detail_qty(Request $request)
    {
        $akun = akun::where('id', $request->akun_id)->first();
        $detail = jurnal_memorial_detail::where('akun_id', $akun->id)
            ->where('jurnal_memorial_id', $request->jurnal_memorial_id)
            ->first();

        $data = $request->validate([
            'tipe_akun' => 'required',
            'jumlah' => 'required|gt:0',
        ]);

        if ($data['tipe_akun'] == 1) {
            jurnal_memorial_detail::where('jurnal_memorial_id', $request->jurnal_memorial_id)
                ->where('akun_id', $request->akun_id)
                ->update([
                    'debet' => $data['jumlah'],
                    'kredit' => 0,
                ]);
        } elseif ($data['tipe_akun'] == 2) {
            jurnal_memorial_detail::where('jurnal_memorial_id', $request->jurnal_memorial_id)
                ->where('akun_id', $request->akun_id)
                ->update([
                    'debet' => 0,
                    'kredit' => $data['jumlah'],
                ]);
        }

        return response()->json([
            'akun' => $akun,
            'detail' => $detail,
        ]);
    }

    public function update_detail(Request $request)
    {
        $idTransaction = $this->getTransactionId();
        $akun_id = $request->akun_id;
        $akun = akun::where('id', $akun_id)->first();

        $data = $request->validate([
            'debet' => 'required|gte:0',
            'kredit' => 'required|gte:0',
        ]);

        $akun_debet = jurnal_memorial_detail::where('akun_id', $akun->id)
            ->where('jurnal_memorial_id', $idTransaction)
            ->value('debet');

        $akun_kredit = jurnal_memorial_detail::where('akun_id', $akun->id)
            ->where('jurnal_memorial_id', $idTransaction)
            ->value('kredit');

        if ($data['debet'] > 0 && $data['kredit'] = 0) {
            jurnal_memorial_detail::where('akun_id', $akun->id)
                ->where('jurnal_memorial_id', $idTransaction)
                ->update([
                    'debet' => $akun_debet + $data['debet'],
                    'kredit' => 0,
                ]);
        } elseif ($data['kredit'] > 0 && $data['debet'] = 0) {
            jurnal_memorial_detail::where('akun_id', $akun->id)
                ->where('jurnal_memorial_id', $idTransaction)
                ->update([
                    'debet' => 0,
                    'kredit' => $akun_kredit + $data['kredit'],
                ]);
        }

        $detail = jurnal_memorial_detail::where('akun_id', $akun->id)
            ->where('jurnal_memorial_id', $idTransaction)
            ->first();

        return response()->json([
            'akun' => $akun,
            'detail' => $detail,
        ]);
    }

    public function delete_detail(Request $request)
    {
        $detail_id = jurnal_memorial_detail::where('akun_id', $request->akun_id)
            ->where('jurnal_memorial_id', $request->jurnal_memorial_id)
            ->value('id');

        $detail = jurnal_memorial_detail::whereId($detail_id)->get();

        jurnal_memorial_detail::destroy($detail_id);

        return response()->json([
            'detail' => $detail,
            'request' => $request->all(),
        ]);
    }

    private function getTransactionId()
    {
        $noTransaksiPembelian = $this->getTransactionNumber();
        $result = jurnal_memorial::where('no_transaction', $noTransaksiPembelian)->first();

        $id = $result->id;

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
                $order = '00' . $order;
            } else if (strlen($order) == 2) {
                $order = '0' . $order;
            }
            $this->transactionNumber = $prefix . '-' . $order;
        }

        return $this->transactionNumber;
    }
}
