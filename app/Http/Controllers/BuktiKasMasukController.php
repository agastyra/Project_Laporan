<?php

namespace App\Http\Controllers;

use App\Models\bukti_kas_masuk;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createBKM = bukti_kas_masuk::create([
            'no_bkm' => $request->no_bkm,
            'transaksi_penjualan_id' => $request->transaksi_penjualan_id,
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

        return view('bkm.edit', compact('bkm', 'trans'));
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