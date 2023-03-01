<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\jurnal_penyesuaian;
use App\Models\jurnal_penyesuaian_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Param;

class jurnal_penyesuaiancontroller extends Controller
{   
    private $transactionNumber;


    public function index()
    {
        $dtpenyesuaian = jurnal_penyesuaian::all();
        // $dtpenyesuaian_detail = jurnal_penyesuaian_detail::all();
        $akuns = akun::all();

        return view('jurnal.penyesuaian.penyesuaian', [
            'jurnal_penyesuaians' => $dtpenyesuaian,
            'akuns' => $akuns, 
            // 'jurnal_penyesuaian_detail' => $dtpenyesuaian_detail,
        ]);
    }


      public function create()
    {
        
        // $akun = akun::all();
        // $dtpenyesuaian = jurnal_penyesuaian::all();
        
        // jurnal_penyesuaian::where('jurnal_penyesuaian_id');
        $akuns = akun::where('is_header_account', false)
            ->orderBy('no_account', 'asc')->get();
        $date = date('Y-m-d'); #2008-11-11

        $noTransaksiPembelian = $this->setNewTransactionNumber();

        // jurnal_penyesuaian::create([
        //     'no_transaction' => $noTransaksiPembelian,
        //     'date' => $date,
        // ]);
        // $akuns = akun::all();
        $jurnal_penyesuaian_detail = jurnal_penyesuaian_detail::all();
        return view('jurnal.penyesuaian.detail', [
            // 'akun' => $akun,
            // 'jurnal_penyesuaians' => $dtpenyesuaian, 
            'jurnal_penyesuaian_detail' => $jurnal_penyesuaian_detail,
            'akuns' => $akuns,
            'date' => $date,

        ]);
    }
    
    
        public function store(Request $request)
    {
        // dd($request->toArray());
       
        // jurnal_penyesuaian::create([
        //     'date' => $request->date,
        //     'no_transaction' => $request->no_transaction,
        // ]);
        $data = $request->all();
        // dd($data);
        $penyesuaian = new jurnal_penyesuaian;
        $penyesuaian->date =$data['date'];
        $penyesuaian->no_transaction =$data['no_transaction'];
        $penyesuaian->save();

        $detailpenyesuaian = new jurnal_penyesuaian_detail;
        $detailpenyesuaian->jurnal_penyesuaian_id =$penyesuaian->id;
        $detailpenyesuaian->akun_id =$data['akun_id'];
        $detailpenyesuaian->debet =$data['debet'];
        $detailpenyesuaian->kredit =$data['kredit'];
        $detailpenyesuaian->save();
        

        return redirect('penyesuaian')->with('toast_success', 'Data Berhasil Di Input');;

        }
         public function get_account_info($id)
    {
        $akun = akun::where('id', $id)->get();
        return response()->json($akun);
    }

    private function getTransactionId()
    {
        $noTransaksiPembelian = $this->getTransactionNumber();
        $result = jurnal_penyesuaian::where('no_transaction', $noTransaksiPembelian)->get();

        $id = $result[0]->id;

        return $id;
    }

    private function getTransactionNumber()
    {
        $result = jurnal_penyesuaian::latest()->value('no_transaction');

        return $result;
    }

    private function setNewTransactionNumber()
    {
        $noTransaksiPembelian = jurnal_penyesuaian::latest()->value('no_transaction');

        if (is_null($noTransaksiPembelian)) {
            $this->transactionNumber = "JM-001";
        } else {
            $noTransaksiPembelian = explode('-', $noTransaksiPembelian);
            $prefix = $noTransaksiPembelian[0];
            $order = (int) $noTransaksiPembelian[0];
            $order++;
            $order = (string) $order;
            if (strlen($order) == 1) {
                $order = '0' . $order;
            }
            $this->transactionNumber = $prefix . '-' . $order;
        }

        return $this->transactionNumber;
    }
 

    public function tampil($id)

    {
    // $penyesuaian = jurnal_penyesuaian::findOrFail($id);
    // $penyesuaianDetail = jurnal_penyesuaian_detail::where('id', $penyesuaian->jurnal_penyesuaian_detail_id)->firstOrFail();
    //     return view('jurnal.penyesuaian.tampil-detail',[
    //         'penyesuaian' => $penyesuaian, 
    //         'penyesuaianDetail' => $penyesuaianDetail,
    //     ]);
    //     $akun = akun::all();
    //     $no_transaksi = jurnal_penyesuaian::all();
        

    //     $penye= jurnal_penyesuaian::where('kredit', true)->get();
    //     return view('jurnal.penyesuaian.detail', [
    //         'penye' => $penye,
    //         'id' => $id,
    //         'akun' => $akun,
    //         'no_transaksi' => $no_transaksi,
    //     ]);
    }
    public function edit($id)
    {
    $penyesuaian = jurnal_penyesuaian::findOrFail($id);
    $penyesuaianDetail = jurnal_penyesuaian_detail::where('id', $penyesuaian->jurnal_penyesuaian_detail_id)->firstOrFail();
    return view('junal.penyesuaian.detail', compact('penyesuaian', 'penyesuaianDetail'));
}

    // public function update(Request $request, $id)
    // {
    //     $penye = jurnal_penyesuaian::findorfail($id);
   
    //     $penye->update($request->all());
    //     return redirect('penyesuaian')->with('toast_success', 'Data Berhasil Update');

    // }
    public function update(Request $request)
{
    $id = $request->jurnal_penyesuaian_detail_id;
    
    $jurnal = jurnal_penyesuaian_detail::where('id',"=",$id)
    ->update([
        "debet"     => $request->debet,
        "kredit"    => $request->kredit
    ]);
    // dd($jurnal);
    // if ($jurnal){
    //     $jurnal->akun_id = $request->akun_id;
    //     $jurnal->debet = $request->debet;
    //     $jurnal->kredit = $request->kredit;
    //     $jurnal->update();

    // }
    // DB::beginTransaction();

    // try {
    //     // Update data pada tabel Model1
    //     // $penyesuaian = jurnal_penyesuaian::findOrFail($id);
    //     // $penyesuaian->date = $request->input('date');
    //     // $penyesuaian->no_transaction = $request->input('no_transaction');
    //     // $penyesuaian->save();

    //     // Update data pada tabel Model2
    //     $penyesuaianDetail = jurnal_penyesuaian_detail::where('id', $request->input('jurnal_penyesuaian_detail_id'))->firstOrFail();
    //     $penyesuaianDetail->akun_id = $request->input('akun_id');
    //     $penyesuaianDetail->debet = $request->input('debet');
    //     $penyesuaianDetail->kredit = $request->input('kredit');
    //     $penyesuaianDetail->save();
    //     return redirect()->back()->with('success', 'Data updated successfully!');

    // //     // DB::commit();
    // //     // return response()->json(['success' => true]);
    // } catch (\Throwable $e) {
    //     DB::rollback();
    //     throw $e;
    // }
     return redirect()->back()->with('success', 'Data updated successfully!');
}
    
     public function destroy($id)
     {
         $penye = jurnal_penyesuaian::findorfail($id);
         $penye->delete();
         return redirect()->route('penyesuaian');
        // return back();
     }

     //untuk penyesuaian_detail
      public function index_detail()

    {
        $dtpenyesuaian_detail = jurnal_penyesuaian::all();

        return view('jurnal.penyesuaian.detail', [
            'jurnal_penyesuaians_details' => $dtpenyesuaian_detail,
        ]);
    }
      public function create_detail()
    {
       
        return view('jurnal.penyesuaian.detail', [
            // 'akun' => $akun,
        ]);
    }
    public function store_detail(Request $request)
    {
        $detail = new jurnal_penyesuaian_detail;
        $detail->akun_id = $request->input('akun_id');
        $detail->debet = $request->input('debet');
        $detail->kredit = $request->input('kredit');
        $detail->save();

        $akun = jurnal_penyesuaian_detail::find($detail->akun_id);

        return response()->json([
            'message' => 'Data berhasil disimpan.',
            'akun' => $akun
        ]);
       
    //     // dd($request->toArray());
    //     // $jurnal_penyesuaian = jurnal_penyesuaian::where('no_transaction', $request->no_transaction)->first();
    //     // $jurnal_penyesuain_id = $jurnal_penyesuaian->id;
       
    //     // jurnal_penyesuaian_detail::create([

    //     //     'jurnal_penyesuaian_id' => $jurnal_penyesuain_id->id, 
    //     //     'akun_id' => $request->akun_id,
    //     //     'debet' => $request->debet,
    //     //     'kredit' => $request->kredit,
    //     // ]);
        // return redirect('simpan_penyesuaian_detail');
    }
    public function show($id)
{
    $akun = jurnal_penyesuaian_detail::find($id);

    return response()->json([
        'akun' => $akun
    ]);
}
 public function destroy_detail($id)
     {
         $peg = jurnal_penyesuaian_detail::findorfail($id);
         $peg->delete();
         return redirect()->route('create-penyesuaian');
        // return back();
     }
}