<?php

namespace App\Http\Livewire\Accounting;

use Livewire\Component;

class BuktiKasKeluar extends Component
{
    public function render()
    {
        return view('livewire.accounting.bukti-kas-keluar')
            ->layout('components.layout.app');
    }
}
