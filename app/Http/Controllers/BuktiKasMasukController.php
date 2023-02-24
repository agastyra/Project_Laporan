<?php

namespace App\Http\Controllers;

use App\Models\bukti_kas_masuk;
use App\Models\jurnal_memorial;
use App\Models\transaksi_penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BuktiKasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $bkm = bukti_kas_masuk::all();
    //     $bkmtotals = DB::table('bukti_kas_masuks')
    //         ->select(DB::raw('SUM(total) as totals'), DB::raw('MONTH(tanggal) as bulan'))
    //         ->groupBy('bulan')
    //         ->get();

    //     return view('bkm.index', [
    //         'bkm' => $bkm,
    //         'bkmtotals' => $bkmtotals
    //     ]);
    // }

    public function index(Request $request)
    {
        $bkm = bukti_kas_masuk::all();
        $bkmtotals = DB::table('bukti_kas_masuks')
            ->select(DB::raw('SUM(total) as totals'), DB::raw('MONTH(tanggal) as bulan'))
            ->groupBy('bulan')
            ->get();

        if ($request->ajax()) {
            $selectedMonth = $request->input('selectedMonth');

            if (!empty($selectedMonth)) {
                $bkm = bukti_kas_masuk::whereMonth('tanggal', $selectedMonth)->get();
            }

            return view('bkm.table', [
                'bkm' => $bkm
            ]);
        }

        return view('bkm.index', [
            'bkm' => $bkm,
            'bkmtotals' => $bkmtotals
        ]);
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi = transaksi_penjualan::all();
        $memo = jurnal_memorial::all();
        $noBKM = bukti_kas_masuk::latest()->first();
        if ($noBKM) {
            $noBKM = substr($noBKM->no_bkm, -1);
            $newNoBKM = $noBKM + 1;
            $noBKM = 'BKM' . '-' . $newNoBKM;
        } else {
            $noBKM = 'BKM-1';
        }

        return view('bkm.create', [
            'transaksi' => $transaksi,
            'memo' => $memo,
            'no_bkm' => $noBKM
        ]);
    }

    public function getTransData($id)
    {
        $trans = transaksi_penjualan::findOrFail($id);
        return response()->json([
            'tanggal' => $trans->date,
            'total' => $trans->grand_total
        ]);
    }

    public function getMemoData($id)
    {
        $memo = jurnal_memorial::findOrFail($id);

        return response()->json([
            'tanggal' => $memo->date,
            'debet' => $memo->debet,
            'kredit' => $memo->kredit
        ]);
    }

    public function debKredCal(Request $request)
    {
        $debet = $request->debet;
        $kredit = $request->kredit;
        $total = $debet - $kredit;

        return response()->json(['total' => $total]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $transaksi_penjualan_id = 0;
        $jurnal_memorial_id = 0;

        if ($request->penjualan_memorial == 'trans') {
            $transaksi_penjualan_id = $request->transaksi_penjualan_id;
        } else if ($request->penjualan_memorial == 'memo') {
            $jurnal_memorial_id = $request->jurnal_memorial_id;
        } else {
            $jurnal_memorial_id = 0;
            $transaksi_penjualan_id=0;
        }

        
        $createBKM = bukti_kas_masuk::create([
            'no_bkm' => $request->no_bkm,
            'transaksi_penjualan_id' => $transaksi_penjualan_id,
            'jurnal_memorial_id' => $jurnal_memorial_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'description' => $request->description
        ]);

        return redirect()->route('bkm.create');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bkm = bukti_kas_masuk::findOrFail($id);
        $trans = transaksi_penjualan::all();
        $memo = jurnal_memorial::all();

        return view('bkm.edit', compact('bkm', 'trans', 'memo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bkm = bukti_kas_masuk::find($id);
        if ($bkm) {
            $trans = transaksi_penjualan::find($bkm->transaksi_penjualan_id);
            if ($trans) {
                $bkm->transaksi_penjualan_id = $request->transaksi_penjualan_id;
                $bkm->jurnal_memorial_id = $request->jurnal_memorial_id;
                $bkm->tanggal = $request->tanggal;
                $bkm->total = $request->total;
                $bkm->description = $request->description;
                $bkm->update();
            }
        }
        return redirect()->route('bkm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}