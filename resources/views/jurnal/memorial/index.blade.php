<x-layout.app>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tabel Jurnal Umum</h4>
                    <div align="right">
                        <a class="positive ui button d-inline-block"
                            href="{{ route('create_memorial') }}">Tambah</a>
                    </div>
                    <div align="left">
                        <button type="button"
                            id="filter_button"
                            class="btn btn-inverse-info btn-icon mb-3">
                            <i class="mdi mdi-filter-outline"></i>
                        </button>
                        <a href="/accounting/memorial/print_memorial?tanggal_awal_filter={{ request('tanggal_awal_filter') }}&tanggal_akhir_filter={{ request('tanggal_akhir_filter') }}"
                            target="_blank"
                            id="print_jurnal"
                            class="btn btn-inverse-primary btn-icon mb-3 d-inline-flex">
                            <i class="mdi mdi-printer m-auto"></i>
                        </a>
                    </div>
                    <div class="row justify-content-start my-4"
                        id="filter_jurnal">
                        <form id="form_filter_jurnal"
                            action="{{ route('memorial') }}">
                            <h5 class="mb-3">Filter :</h5>
                            <div class="col">
                                <div class="col-md-4 d-flex flex-column">
                                    <h6 class="my-auto">Tanggal awal : </h5>
                                </div>
                                <div class="col my-3">
                                    <input type="date"
                                        name="tanggal_awal_filter"
                                        id="tanggal_awal_filter"
                                        class="form-control text-light"
                                        value="{{ old('tanggal_awal_filter') }}">
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
                                        class="form-control text-light"
                                        value="{{ old('tanggal_akhir_filter') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('memorial') }}"
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-md">#</th>
                                    <th scope="col-md">Tanggal</th>
                                    <th scope="col-md">No Transaksi</th>
                                    <th scope="col-md">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jurnal_memorials as $jurnal_memorial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jurnal_memorial->date }}</td>
                                        <td>{{ $jurnal_memorial->no_transaction }}</td>
                                        <td>
                                            <a href="{{ route('detail_memorial', $jurnal_memorial->no_transaction) }}"
                                                class="text-decoration-none link-light badge bg-primary border-0">
                                                <i class="mdi mdi-file-document-box-outline"></i>
                                            </a>
                                            @can('office.tetap')
                                                <form action="{{ route('memorial', $jurnal_memorial->no_transaction) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $jurnal_memorials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('jssj')
        <script src="{{ asset('assets/js/jurnal_memorial/memo.js') }}"></script>
    @endpush
</x-layout.app>
