<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('simpan-penyesuaian') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row mt-5">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                No</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="text"
                                    placeholder="Masukkan No Transaksi" name="no_transaction" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                Tanggal</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="date" value="{{ date('y-m-d') }}"
                                    id="date" name="date" placeholder="masukan jumlah disni" />
                            </div>
                        </div>
                        <div class="col-sm-3 mt-4">
                            <button type="submit" class="positive ui button">
                                Simpan</button> <a class="negative ui button"
                                href="{{ route('penyesuaian') }}">Batal</a>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single" style="width:100%" name="akun_id">
                                            <option value="0"> - Pilih Nama Akun - </option>
                                            @foreach ($akun as $ak)
                                                <option value="{{ $ak->id }}"
                                                    {{ old('jurnal_penyesuaians_id') == $ak->id ? 'selected' : '' }}>
                                                    ({{ $ak->no_account }})
                                                    {{ $ak->name_account }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    {{-- <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Saldo</label>
                                    <div class="col-sm-8">
                                        <select class="form-control text-light" style="width:100%" name="akuns_id">
                                            <option value="0">-Pilih Saldo-</option>
                                            <option value="AL">Debet</option>
                                            <option value="WY">Kredit</option> --}}
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Debit
                                    </label>
                                    <div class="col-sm-7">
                                        <input class="form-control text-light" type="text" name="total_debet"
                                            id="debit" />
                                    </div>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-7">
                                        <input class="form-control text-light" type="text" name="total_kredit"
                                            id="kredit" />
                                        <div class="col-sm-3 mt-4">
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="mdi mdi-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-tittle"><i
                                                    class="mdi mdi-table-edit text-danger icon-md"></i> Tabel

                                            </h4>
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
                                                                            method="POST"> @method('delete') @csrf
                                                                            <button class="badge bg-danger border-0"
                                                                                onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                                                                <i
                                                                                    class="mdi mdi-trash-can-outline"></i>
                                                                                {{-- </button>
                                                            <i class="mdi mdi-trash-can-outline" style="color: red"></i></a> --}}
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
                                        </div>
                                    </div>
                                </div>
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
                //         let deb = $("#debit").val();
                //         let kre = $("#kredit").text();

                //         if (deb > 0) {
                //             let kre = 0;
                //             $("#kredit").html(kre);
                //         }
                //     });
            });
        </script>
    @endpush
</x-layout.app>
