<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('simpan_penyesuaian_detail') }}" method="POST">
                        {{ csrf_field() }}
                        <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal
                            Penyesuaian_Detail
                        </h4>
                        {{-- <div class="form-group row mt-5">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                            Rincian</label>
                        <div class="col-sm-9">
                            <input class="form-control text-light" type="text" placeholder="Masukkan Rincian" />
                        </div>
                    </div> --}}
                        {{-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                            Tanggal</label>
                        <div class="col-sm-9">
                            <input class="form-control text-light" type="date" />
                        </div>
                    </div> --}}
                        <div class="row">
                            <div class="col-lg-5 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><i class="mdi mdi-cash number"></i>
                                        Masukan Nomor </label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light" type="number"
                                            name="jurnal_penyesuaians_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-9">
                                        <input class="js-example-basic-single" style="width:100%" name="akuns_id">


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Debit</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light" type="number" name="debet"
                                            id="debit" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light" type="number" name="kredit"
                                            id="kredit" />
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="btn btn-success"><i class="mdi mdi-plus"></i>
                                                Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($jurnal_penyesuaians_details as $id)
                                            <tr>
                                                <td>{{ $id->jurnal_penyesuaian_id }}</td>
                                                <td>{{ $id->akuns_id }}</td>
                                                <td>{{ $id->debet }}</td>
                                                <td>{{ $id->kredit }}</td>
                                                <td>
                                                    <a href="{{ url('penyesuaian_detail', $id->id) }}"
                                                        class="text-decoration-none link-light badge bg-primary border-0"><i
                                                            class="mdi mdi-file-document-edit-outline"></i></a>
                                                    |
                                                    <a href="{{ url('penyesuaian/delete-penyesuaian', $id->id) }}"
                                                        method="POST"> @method('delete') @csrf <button
                                                            class="badge bg-danger border-0"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                        {{-- <i class="mdi mdi-trash-can-outline" style="color: red"></i></a> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('jssj')
        <script>
            $(document).ready(function() {
                $("#debit").keyup(function() {
                    $("#kredit").val(0);
                });

                $("#kredit").keyup(function() {
                    $("#debit").val(0);
                });
            });
        </script>
    @endpush

</x-layout.app>
