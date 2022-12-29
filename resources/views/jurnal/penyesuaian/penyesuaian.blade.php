<x-layout.app>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal Penyesuaian
                    </h4>
                    <div class="form-group row mt-5">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                            Rincian</label>
                        <div class="col-sm-9">
                            <input class="form-control text-light" type="text" placeholder="Masukkan Rincian" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                            Tanggal</label>
                        <div class="col-sm-9">
                            <input class="form-control text-light" type="date" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                    Akun</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="AM">America</option>
                                        <option value="CA">Canada</option>
                                        <option value="RU">Russia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
