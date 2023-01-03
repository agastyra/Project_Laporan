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
                                        <option value="AL">01</option>
                                        <option value="WY">02</option>
                                        <option value="AM">03</option>
                                        <option value="CA">04</option>
                                        <option value="RU">05</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                    Debit</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-light" type="number" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                    Kredit</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-light" type="number" />
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
                                        <th>Tanggal</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 01 </td>
                                        <td>300.000</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
