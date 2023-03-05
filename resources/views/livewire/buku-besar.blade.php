<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi-table-large text-danger"></i>
                        Buku Besar
                    </h4>
                    <div class="row justify-content-start">
                        <div class="col-md-1 d-flex flex-column">
                            <h5 class="my-auto">Akun : </h5>
                        </div>
                        <div class="col-md-11">
                            <select class="form-select form-control text-light"
                                wire:model="selectedAkun"
                                id="akun">
                                <option value="">-</option>
                                @forelse ($accounts as $account)
                                    <option value="{{ $account->id }}">( {{ $account->no_account }} )
                                        {{ $account->name_account }}</option>
                                @empty
                                    <option value="">-- Tidak ada data --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <h5>{{ $akun }}</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-md">Tanggal</th>
                                    <th scope="col-md">Keterangan</th>
                                    <th scope="col-md">Ref</th>
                                    <th scope="col-md">Debet</th>
                                    <th scope="col-md">Kredit</th>
                                    <th scope="col-md">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($buku_besar as $bb)
                                    <tr>
                                        <td>{{ $bb->date }}</td>
                                        <td>{{ $bb->keterangan }}</td>
                                        <td>{{ $bb->no_account }}</td>
                                        <td>
                                            @if ($bb->debet == '-')
                                                -
                                            @else
                                                Rp. {{ number_format($bb->debet, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bb->kredit == '-')
                                                -
                                            @else
                                                Rp. {{ number_format($bb->kredit, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($bb->saldo_akhir, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
