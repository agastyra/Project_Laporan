<?php

namespace App\Http\Livewire;

use App\Models\akun;
use Livewire\Component;

class BukuBesar extends Component
{
    public $selectedAkun = '';
    public $akun = '';

    public function render()
    {
        $jurnal_memorial = akun::join('jurnal_memorial_details', 'akuns.id', '=', 'jurnal_memorial_details.akun_id')
        ->join('jurnal_memorials', 'jurnal_memorials.id', '=', 'jurnal_memorial_details.jurnal_memorial_id')
        ->select(
            'jurnal_memorials.id as id',
            'jurnal_memorials.date as tanggal',
            'akuns.id as akun_id',
            'akuns.no_account as no_account',
            'akuns.name_account as name_account',
            'jurnal_memorial_details.debet as debet',
            'jurnal_memorial_details.kredit as kredit'
        )->get();

        $jurnal_penyesuaian = akun::join('jurnal_penyesuaian_details', 'akuns.id', '=', 'jurnal_penyesuaian_details.akun_id')
        ->join('jurnal_penyesuaians', 'jurnal_penyesuaians.id', '=', 'jurnal_penyesuaians.jurnal_penyesuaian_id')
        ->select(
            'jurnal_penyesuaians.id as id',
            'jurnal_penyesuaians.date as tanggal',
            'akuns.id as akun_id',
            'akuns.no_account as no_account',
            'akuns.name_account as name_account',
            'jurnal_penyesuaian_details.debet as debet',
            'jurnal_penyesuaian_details.kredit as kredit'
        )->get();

        dd($jurnal_memorial . $jurnal_penyesuaian);

        $accounts = akun::orderBy('no_account', 'asc')->get();
        return view('livewire.buku-besar', [
            'accounts' => $accounts,
        ])->layout('components.layout.app');
    }

    public function updatedSelectedAkun($value)
    {
        $this->akun = $value;
    }
}
