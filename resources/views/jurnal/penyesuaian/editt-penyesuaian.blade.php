<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Data Penyesuaian</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-penyesuaian', $id->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group row mt-5">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                NO</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="text"
                                    value="{{ old('no_transaction', $id->no_transaction) }}"
                                    placeholder="Masukkan Rincian" name="no_transaction" />
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                    Tanggal</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-light" type="date"
                                        value="{{ old('date', $id->date) }}" id="date" name="date"
                                        placeholder="masukan jumlah disni" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mt-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><i
                                                class="mdi mdi-account text-primary"></i>
                                            Akun</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single" style="width:100%" name="akuns_id">
                                                {{-- <option value="0"> - Pilih Nama Akun - </option> --}}
                                                @foreach ($akun as $ak)
                                                    @if (old('name_name', $ak->name_account))
                                                        <option value="{{ old('id', $ak->id) }}">
                                                            ({{ $ak->no_account }})
                                                            {{ old('name_account', $ak->name_account) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                            Debit</label>
                                        <div class="col-sm-9">
                                            <input class="form-control text-light" type="number" id="debit"
                                                name="debet" value="{{ old('debet', $id->debet) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                            Kredit</label>
                                        <div class="col-sm-9">
                                            <input class="form-control text-light" type="number" id="kredit"
                                                name="kredit" value="{{ old('kredit', $id->kredit) }}">
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="positive ui button">
                                                    Ubah Data</button> <a class="negative ui button"
                                                    href="{{ url('penyesuaian') }}">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--modal-->
                            {{-- <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog"
                            aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">Hapus Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="display4">
                                                <h4>Apakah data Ingin dihapus?</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                class="mdi mdi-window-close"></i> Batal</button>
                                        <button type="submit" class="btn btn-success"><i class="mdi mdi-check"></i>
                                            Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
