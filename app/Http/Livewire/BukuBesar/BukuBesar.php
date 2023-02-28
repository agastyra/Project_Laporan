<?php

namespace App\Http\Livewire\BukuBesar;

use App\Models\akun;
use App\Models\bukti_kas_keluar;
use Livewire\Component;

class BukuBesar extends Component
{
    public $month;
    public $accounts;
    public $selectedAccount = null;
    public $bukti_kas_keluars = null;

    public function mount()
    {
        $this->month = date('Y-m');
        $this->accounts = akun::where('is_header_account', false)->orderBy('no_account', 'asc')->get();
    }

    public function updatedSelectedAccount()
    {
        $this->bukti_kas_keluars = bukti_kas_keluar::where('akun_id', $this->selectedAccount)
            ->orderBy('tanggal', 'asc')
            ->orderBy('no_transaction', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.buku-besar.buku-besar')
            ->layout('components.layout.app');
    }
}
