<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal Umum (
                        {{ $no_transaction }} )
                    </h4>
                    <div class="row">
                        <label class="col-sm-2 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                            Tanggal</label>
                        <div class="col-sm">
                            <input class="form-control text-lig"
                                type="date"
                                name="date"
                                value="{{ $date }}" />
                        </div>
                    </div>
                    <form id="form-account">
                        <div class="row">
                            @csrf
                            <div class="col-lg-4 mt-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single"
                                            name="akun_id"
                                            id="akun_id_memo"
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
                            <div class="col-lg-4 mt-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Debit</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light"
                                            placeholder="Please fill this input..."
                                            type="number"
                                            id='debet_memo'
                                            name="debet" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-8">
                                        <input class="form-control text-light"
                                            type="number"
                                            name="kredit"
                                            placeholder="Please fill this input..."
                                            id="kredit_memo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 d-flex">
                                <button class="m-auto btn btn-icon btn-success btn-sm"
                                    type="submit">
                                    <i class="mdi mdi-plus-box"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row my-4">
                        <div class="col-sm-12">
                            <a href="{{ route('memorial') }}"
                                class="btn btn-danger"><i class="mdi mdi-trash-can"></i>
                                Batal</a>
                            <button type="button"
                                id="button-submit-memorial"
                                class="btn btn-success"><i class="mdi mdi-note"></i>
                                Simpan</button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table class="table table-dark"
                                id="table_detail_akun">
                                <thead>
                                    <tr>
                                        <th>Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_detail_akun_body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade"
        id="modal-edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit_akun"
        aria-hidden="true">
        <div class="modal-dialog"
            role="document">
            <form id="update-akun">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="edit_akun">Edit akun</h5>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <input type="hidden"
                                name="jurnal_memorial_id"
                                id="detail_memorial_id">
                            <input type="hidden"
                                name="akun_id"
                                id="detail_akun_id">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama akun</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark"
                                        id="detail_nama"
                                        name="name_akun"
                                        readonly
                                        disabled />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tipe</label>
                                <div class="col-sm-9">
                                    <select name="tipe_akun"
                                        id="detail_akun_tipe"
                                        class="form-select form-control text-light">
                                        <option value=""> -- </option>
                                        <option value="1">Debet</option>
                                        <option value="2">Kredit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-white"
                                        type="number"
                                        placeholder="0"
                                        id="akun_amount"
                                        name="jumlah" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"><i class="mdi mdi-window-close"></i> Tutup</button>
                        <button type="submit"
                            class="btn btn-success"><i class="mdi mdi-floppy"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade"
        id="modal-hapus"
        tabindex="-1"
        role="dialog"
        aria-labelledby="delete_akun"
        aria-hidden="true">
        <div class="modal-dialog"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="delete_akun">Hapus akun</h5>
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="hapus-akun">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="display4">
                                <h4>Apakah akun Ingin dihapus?</h4>
                                <input type="hidden"
                                    name="akun_id"
                                    id="delete-akun-id">
                                <input type="hidden"
                                    name="jurnal_memorial_id"
                                    id="delete-jurnal-memorial-id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"><i class="mdi mdi-window-close"></i> Batal</button>
                        <button type="submit"
                            class="btn btn-success"><i class="mdi mdi-check"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('jssj')
        <script src="{{ asset('assets/js/jurnal_memorial/index.js') }}"></script>
    @endpush
</x-layout.app>
