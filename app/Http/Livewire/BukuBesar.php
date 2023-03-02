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
        $buku_besars =

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
