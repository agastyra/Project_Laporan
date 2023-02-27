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
                                        name="no_transaction" id="no_transaction" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                    Tanggal</label>
                                <div class="col-sm-7">
                                    <input class="form-control text-dark disabled" type="date" name="date"
                                        id="date" readonly value="{{ old('date', $date) }}" />
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
                                        <select class="js-example-basic-single" name="akun_id" id="akun_id_detai"
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
                                    @forelse ($jurnal_penyesuaian_detail as $detail)
                                        <tr>
                                            {{-- <td>{{ date('d-m-y', strtotime($detail->date)) }}</td> --}}
                                            <td>{{ $detail->akun->name_account }}</td>
                                            <td>{{ $detail->debet }}</td>
                                            <td>{{ $detail->kredit }}</td>
                                            {{-- <td>aktiva lancar</td>
                                        <td>50000</td>
                                        <td>0</td> --}}
                                            <td>

                                                <a class="text-decoration-none link-light badge bg-primary border-0 update-button"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-detail-id="{{ $detail->id }}"
                                                    data-detail-akun-id="{{ $detail->akun->id }}"
                                                    data-detail-debet="{{ $detail->debet }}"
                                                    data-detail-kredit="{{ $detail->kredit }}"><i
                                                        class="mdi mdi-file-document-edit-outline"></i>
                                                </a>
                                                <form action="{{ url('penyesuaian/delete-detail', $detail->id) }}"
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
    {{-- Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="{{ route('update-penyesuaian') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        {{-- hapus en value e --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                <input type="hidden" name="jurnal_penyesuaian_detail_id" id="detail_id">
                                Akun</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="akun_id" id="akun_id_detail"
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
                                    id='debet_detail_modal' name="debet" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i
                                    class="mdi mdi-cash text-warning"></i>Kredit</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" placeholder="Masukan nominal" type="number"
                                    id='kredit_detail_modal' name="kredit" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                    class="mdi mdi-window-close"></i> Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="mdi mdi-floppy"></i>
                                Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    @push('jssj')
        <script>
            $(document).ready(function() {
                let baseUrl =
                    $(location).attr("protocol") + "//" + $(location).attr("host") + "/";


                // $('#editModal').on('show.bs.modal', function(event) {
                $(document).on('click', '.update-button', function() {
                    let button = $(event.relatedTarget) // Button that triggered the modal
                    let data_detail_id = $(this).data('detail-id');
                    let detail_akun_id = $(this).data('detail-akun-id');

                    let debet = $(this).data('detail-debet');
                    let kredit = $(this).data('detail-kredit');
                    console.log(data_detail_id);
                    console.log(detail_akun_id);
                    console.log(debet);
                    console.log(kredit);

                    $('#editModal').modal('show');
                    //  $('#editModal').on('show.bs.modal') 
                    $('#detail_id').val(data_detail_id);
                    $('#debet_detail_modal').val(debet);
                    $('#kredit_detail_modal').val(kredit);
                    // let data_detail_id = button.data('data-detail-id')
                    // let detail_akun_id = button.data('detail-akun-id')
                    // let debet = button.data('detail-debet')
                    // let kredit = button.data('detail-kredit')

                    // let modal = $(this)
                    // modal.find('.modal-body #detail-id').val(data_detail_id);
                    // modal.find('.modal-body #debet_detail').val(debet);
                    // modal.find('.modal-body #kredit_detail').val(kredit);
                    $.ajax({
                        url: '{{ route('update-penyesuaian') }}',
                        type: "PUT",
                        data: formData,
                        success: function(data) {
                            // Reload page or update data table
                            console.log('ok');
                        }
                    });
                });



            });
        </script>


        {{-- <script>
            //     $(document).ready(function() {
            //                 $('#editModal').on('show.bs.modal', function(event) {
            //                     var button = (event.relatedTarget)
            //                     var date = button.data('mydate')
            //                     var no_transaction = button.data('myno_transaction')
            //                     var akun = button.data('myakun')
            //                     var debet = button.data('mydebet')
            //                     var kredit = button.data('mykredit')

            //                     var modal = $(this)
            //                     modal.find('.modal-body #no_transaction').val(no_transaction);
            //                     modal.find('.modal-body #date').val(date);
            //                     modal.find('.modal-body #akun_id_detail').val(ak);
            //                     modal.find('.modal-body #debet').val(debet);
            //                     modal.find('.modal-body #kredit').val(kredit);
            //                 })
            //             }
            // 
        </script> --}}
        {{-- <script src="{{ asset('assets/js/jurnal_penyesuaian/index.js') }}"></script> --}}
    @endpush
</x-layout.app>
