<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8"><i class="mdi mdi-scale-balance text-danger icon-md"></i> Neraca Saldo
                        </h4>
                        <div class="col-md-3 mb-3">
                            <div class="row">
                                <div class="col-sm-3 d-flex">
                                    <label for="bulan_filter" class="my-auto">Bulan:</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="month" id="bulan_filter" name="bulan_filter" wire:model='selectedMonth' class="form-control text-light">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <a href="/accounting/trial-balance/print_trial_balance" target="_blank" id="print_neraca_saldo" class="btn btn-inverse-primary btn-icon mb-3 d-inline-flex">
                                <i class="mdi mdi-printer m-auto"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No. Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($neraca_saldo as $detail)
                                <tr>
                                    <td>{{ $detail->no_account }}</td>
                                    <td>{{ $detail->name_account }}</td>
                                    <td class="debit">@if ($detail->debet == '-')
                                        -
                                        @else
                                        Rp. {{ number_format((float) $detail->debet, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="credit">@if ($detail->kredit == '-')
                                        -
                                        @else
                                        Rp. {{ number_format((float) $detail->kredit, 0, ',', '.') }}
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan='4'>Tidak ada akun yang tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <th colspan="2" class="text-center">Total</th>
                                <th>Rp. {{ number_format((float) $sumDebet, 0, ',', '.') }}</th>
                                <th>Rp. {{ number_format((float) $sumKredit, 0, ',', '.') }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>