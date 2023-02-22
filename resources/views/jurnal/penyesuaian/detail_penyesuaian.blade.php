<x-layout.app>

    <div class="row">
        @if (session('toast_success'))
            <div class="alert alert-success">
                {{ session('toast_success') }}
            </div>
        @endif
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
                                    value="{{ old('no_transaction') }}" placeholder="Masukkan No Transaksi"
                                    name="no_transaction" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                Tanggal</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="date" value="{{ old('date') }}"
                                    id="date" name="date" placeholder="masukan jumlah disni" />
                            </div>
                        </div>
                        <div class="col-sm-3 mt-4" style="float: right">
                            <button type="submit" class="positive ui button">
                                Simpan</button> <a class="negative ui button" href="{{ url('penyesuaian') }}">Batal</a>
                        </div>
                    </form>
                    <div class="row">
                        {{-- <form action="{{ route('simpan_penyesuaian_detail') }}" method="POST"> --}}
                        {{-- <form id="detail_penyesuaian" method="POST">
                            @csrf --}}
                        <div class="col-lg-5 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                    Akun</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%" name="akun_id"
                                        id="detail-akun">
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
                        <div class="col-lg-5 mt-5">
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
                                    <input class="form-control text-light" type="text" value="{{ old('debet') }}"
                                        name="debet" id="debit" />
                                </div>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                    Kredit</label>
                                <div class="col-sm-7">
                                    <input class="form-control text-light" type="text" value="{{ old('kredit') }}"
                                        name="kredit" id="kredit" />
                                    <div class="col-sm-3 mt-4">
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="btn btn-success"><i class="mdi mdi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i>
                                        Tabel
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

                                                    @forelse ($jurnal_penyesuaians as $id)
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
                                                                <a href="{{ url('delete-penyesuaian', $id->id) }}"
                                                                    method="POST"> @method('delete') @csrf
                                                                    <button class="badge bg-danger border-0"
                                                                        onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                                    </button>

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
            </div>
        </div>
    </div>

    @push('jssj')
        <script>
            $(document).ready(function() {
                let baseUrl =
                    $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

                $("#debit").keyup(function() {
                    $("#kredit").val(0);
                });

                $("#kredit").keyup(function() {
                    $("#debit").val(0);
                });
            });

            $('#form-detail_penyesuaian').submit(function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/simpan-detail_penyesuaian',
                    data: form_data,
                    success: function(response) {
                        $('#detail-akun').html(response.akun.no_akun + ' - ' + response.akun
                            .nama_akun + ' (Debet: ' + response.akun.debet + ', Kredit: ' +
                            response.akun.kredit + ')');
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error
                    }
                });
            });
        </script>
    @endpush
</x-layout.app>
