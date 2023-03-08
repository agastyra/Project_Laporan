<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi mdi-book-open-page-variant text-danger"></i>
                        Buku Besar
                    </h4>
                    <div align="left">
                        <button type="button"
                            id="filter_button"
                            class="btn btn-inverse-info btn-icon mb-3">
                            <i class="mdi mdi-filter-outline"></i>
                        </button>
                        <a href="/accounting/ledger/print_ledger?akun_id={{ request('akun_id') }}&tanggal_awal_filter={{ request('tanggal_awal_filter') }}&tanggal_akhir_filter={{ request('tanggal_akhir_filter') }}"
                            target="_blank" 
                            id="print_buku_besar"
                            class="btn btn-inverse-primary btn-icon mb-3 d-inline-flex">
                            <i class="mdi mdi-printer m-auto"></i>
                        </a>
                    </div>
                    <form id="form_filter_buku_besar"
                        action="{{ route('ledger') }}">
                        <div class="row justify-content-start my-4">
                            <div class="col-md-1 d-flex flex-column">
                                <h5 class="my-auto">Akun : </h5>
                            </div>
                            <div class="col-md-11">
                                <select class="form-select form-control text-light"
                                    wire:model.lazy="selectedAkun"
                                    name="akun_id"
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
                        <div class="row justify-content-start my-4"
                            id="filter_buku_besar">
                            <h5 class="mb-3">Filter :</h5>
                            <div class="col">
                                <div class="col-md-4 d-flex flex-column">
                                    <h6 class="my-auto">Tanggal awal : </h5>
                                </div>
                                <div class="col my-3">
                                    <input type="date"
                                        name="tanggal_awal_filter"
                                        id="tanggal_awal_filter"
                                        class="form-control text-light">
                                </div>
                            </div>
                            <div class="col">
                                <div class="col-md-4 d-flex flex-column">
                                    <h6 class="my-auto">Tanggal akhir : </h6>
                                </div>
                                <div class="col my-3">
                                    <input type="date"
                                        name="tanggal_akhir_filter"
                                        id="tanggal_akhir_filter"
                                        class="form-control text-light">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('ledger') }}"
                                    class="btn btn-inverse-danger btn-icon my-auto d-inline-flex">
                                    <i class="mdi mdi-backup-restore m-auto"></i>
                                </a>
                                <button type="submit"
                                    class="btn btn-inverse-success btn-icon my-auto">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                            </div>
                    </form>
                </div>
                <div class="table-responsive mt-4">
                    <h5 class="italic">{{ $akun }}</h5>
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
                            @forelse ($query as $buku_besar)
                                <tr>
                                    <td>{{ $buku_besar->date }}</td>
                                    <td>{{ $buku_besar->keterangan }}</td>
                                    <td>{{ $buku_besar->no_account }}</td>
                                    <td>
                                        @if ($buku_besar->debet == '-')
                                            -
                                        @else
                                            Rp. {{ number_format($buku_besar->debet, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($buku_besar->kredit == '-')
                                            -
                                        @else
                                            Rp. {{ number_format($buku_besar->kredit, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($buku_besar->saldo_akhir, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('jssj')
    <script src='{{ asset('assets/js/buku_besar/index.js') }}'></script>
@endpush

</div>
