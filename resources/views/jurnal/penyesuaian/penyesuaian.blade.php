<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal
                        Penyesuaian
                    </h4>
                    <div class="row">
                        <div class="col-lg-4 mt-5">
                            {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                    Akun</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%cvx" disabled>
                                        <option value="AL">01</option>
                                        <option value="WY">02</option>
                                        <option value="AM">03</option>
                                        <option value="CA">04</option>
                                        <option value="RU">05</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="content">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="positive ui button">
                                    <a href="{{ route('create-penyesuaian') }}" class="btn btn-succes">Tambah<i
                                            class="mdi mdi-plus ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            {{-- <table class="table table-dark"> --}}
                            <table id="list-barang" class="table table-dark table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color:black" scope="col-md">Tanggal</th>
                                        <th style="background-color:black" scope="col-md">No Transaction</th>
                                        <th style="background-color:black" scope="col-md">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($jurnal_penyesuaians as $detail)
                                        <tr>
                                            <td>{{ date('d-m-y', strtotime($detail->date)) }}</td>
                                            <td>{{ $detail->no_transaction }}</td>
                                            <p>{{ $detail->debet }}</p>
                                            <p>{{ $detail->kredit }}</p>


                                            <td>
                                                <a href="{{ route('tampil-detail', $detail->id) }}"
                                                    class="text-decoration-none
                                                    link-light badge bg-primary border-0"><i
                                                        class="mdi mdi-file-document-edit-outline"></i></a>
                                                |
                                                <form action="{{ url('penyesuaian/delete-penyesuaian', $detail->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
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
                </div>
            </div>
        </div>
    </div>
    {{-- modal  --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                </div>
                <form id="editForm" action="{{ route('update-penyesuaian') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                Akun</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="akun_id" id="tampil_akun_id"
                                    style="width:100%">
                                    {{-- <option value=""> -- </option> --}}
                                    @forelse ($akuns as $akun)
                                        <option value="{{ $akun->id }}">( {{ $akun->no_account }} )
                                            {{ $akun->name_account }}</option>
                                    @empty
                                        <option value="">-- Tidak ada data --</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i
                                    class="mdi mdi-cash text-warning"></i>Debet</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" placeholder="Masukan nominal" type="number"
                                    id="tampil_debet" name="debet" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i
                                    class="mdi mdi-cash text-warning"></i>Kredit</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" placeholder="Masukan nominal" type="number"
                                    id="tampil_kredit" name="kredit" />
                            </div>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="mdi mdi-window-close"></i> Tutup</button>
            </div>
            {{-- <div class="modal-footer"> --}}

            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            {{-- </div> --}}
        </div>
    </div>
    {{-- @push('jssj')
        <script>
            $(document).ready(function() {
                let baseUrl =
                    $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

                // $('#editModal').on('show.bs.modal', function(event) {
                $(document).on('click', '.update-button', function() {
                    let button = $(event.relatedTarget) // Button that triggered the modal
                    let debet = $(this).data('tampil-debet');
                    let kredit = $(this).data('tampil-kredit');
                    console.log(debet);
                    console.log(kredit);

                    $('#editModal').modal('show');
                    $('#tampil_debet').val(debet);
                    $('#tampil_kredit').val(kredit);

                });
            });

            // $(document).ready(function() {
            //     $('#saveBtn').on('click', function() {
            //         // Proses penyimpanan data ke database
            //         $('#editModal').modal('hide');
            //     });
            // });
        </script>
    @endpush --}}

</x-layout.app>
