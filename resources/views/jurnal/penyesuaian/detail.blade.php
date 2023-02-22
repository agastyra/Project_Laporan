<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal penyesuaian
                    </h4>
                    <form action="{{ route('simpan-penyesuaian') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group row mt-">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                    No</label>
                                <div class="col-sm-7">
                                    <input class="form-control text-light" type="text"
                                        value="{{ old('no_transaction') }}" placeholder="Masukkan No Transaksi"
                                        name="no_transaction" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                    Tanggal</label>
                                <div class="col-sm-7">
                                    <input class="form-control text-dark disabled" type="date" name="date"
                                        readonly value="{{ $date }}" />
                                </div>
                                {{-- <div class="col-sm-1">
                                    <button class="btn btn-icon btn-success btn-sm" type="submit">
                                        <i class="mdi mdi-plus-box" href="{{ url('penyesuaian') }}"></i>
                                    </button>
                                </div> --}}
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-7">
                                        <select class="js-example-basic-single" name="akun_id" id="akun_id_memo"
                                            style="width:100%">
                                            <option value=""> -- </option>
                                            @forelse ($akuns as $akun)
                                                <option value="{{ $akun->id }}">( {{ $akun->no_account }} )
                                                    {{ $akun->name_account }}</option>
                                            @empty
                                                <option value="">-- Tidak ada data --</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Debit</label>
                                    <div class="col-sm-7">
                                        <input class="form-control text-light" placeholder="Masukan nominal"
                                            value="{{ old('debet') }}" type="number" id='debet_detail'
                                            name="debet" />
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-7">
                                        <input class="form-control text-light" type="number" name="kredit"
                                            value="{{ old('kredit') }}" placeholder="Masukan nominal"
                                            id="kredit_detail" />
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-icon btn-success btn-sm" type="submit">
                                            <i class="mdi mdi-plus-box" href="{{ url('penyesuaian') }}"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jurnal_penyesuaian_detail as $id)
                                        <tr>
                                            {{-- <td>{{ date('d-m-y', strtotime($id->date)) }}</td> --}}
                                            <td>{{ $id->akun->name_account }}</td>

                                            <td>{{ $id->debet }}</td>
                                            <td>{{ $id->kredit }}</td>

                                            {{-- <td>aktiva lancar</td>
                                        <td>50000</td>
                                        <td>0</td> --}}
                                            <td>
                                                <a href="{{ url('/penyesuaian/editt-penyesuaian', $id->id) }}"
                                                    class="text-decoration-none link-light badge bg-primary border-0"><i
                                                        class="mdi mdi-file-document-edit-outline"></i>
                                                </a>
                                                <form action="{{ url('penyesuaian/delete-detail', $id->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('jssj')
        <script src="{{ asset('assets/js/jurnal_penyesuaian/index.js') }}"></script>
    @endpush
</x-layout.app>
