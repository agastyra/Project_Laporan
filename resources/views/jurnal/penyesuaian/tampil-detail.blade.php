<x-layout.app>
    @foreach ($penyesuaians as $penyesuaian)
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- <form action="#" method="POST">
                            {{ csrf_field() }} --}}
                        <div class="form-group row mt-5">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                No</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="text"
                                    value="{{ $penyesuaian->no_transaction }}" placeholder="Masukkan No Transaksi"
                                    name="no_transaction" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                Tanggal</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="date" value="{{ $penyesuaian->date }}"
                                    id="date" name="date" placeholder="masukan jumlah disni" />
                            </div>
                        </div>
                        {{-- <div class="col-sm-3 mt-4" style="float: right">
                            <button type="submit" class="positive ui button">
                                Simpan</button> <a class="negative ui button" href="{{ url('penyesuaian') }}">Batal</a>
                        </div> --}}
                        {{-- </form> --}}
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i>
                                            Tabel Detail
                                        </h4>
                                        <div class="col-md-12 mt-3">
                                            <div class="table-responsive">
                                                <table class="table table-dark">
                                                    <thead>
                                                        <tr>

                                                            <th>Akun</th>
                                                            <th>Debit</th>
                                                            <th>Kredit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_detail_akun_body">
                                                        @foreach ($penyesuaian->jurnal_penyesuaian_detail as $detail)
                                                            <tr>
                                                                {{-- <td>{{ date('d-m-y', strtotime($detail->date)) }}</td> --}}
                                                                <td>{{ $detail->akun->name_account }}</td>
                                                                <td>{{ $detail->debet }}</td>
                                                                <td>{{ $detail->kredit }}</td>
                                                            </tr>
                                                        @endforeach
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
        {{-- 
    @push('jssj')
        {{-- <script>
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
               $("#debit_detail_modal").keyup(function() {
                    if (
                        $("#kredit_detail_modal").val() == "" ||
                        $("#kredit_detail_modal").val() == null ||
                        $("#kredit_detail_modal").val() == undefined ||
                        $("#kredit_detail_modal").val() == 0
                    ) {
                        $("#kredit_detail_modal").val("0");
                    } else {
                        $("#debet_detail_modal").val("0");
                    }
                });

                $("#kredit_detail_modal").keyup(function() {
                    if (
                        $("#debet_detail_modal").val() == "" ||
                        $("#debet_detail_modal").val() == null ||
                        $("#debet_detail_modal").val() == undefined ||
                        $("#debet_detail_modal").val() == 0
                    ) {
                        $("#debet_detail_modal").val("0");
                    } else {
                        $("#kredit_detail_modal").val("0");
                    }
                });
        </script> --}}
        {{-- @endpush --}}
    @endforeach
</x-layout.app>
