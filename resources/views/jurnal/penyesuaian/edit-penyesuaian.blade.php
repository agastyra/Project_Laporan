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
                        {{-- <div class="form-group row mt-5">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                Keterangan</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="text" placeholder="Masukkan Rincian" />
                            </div> --}}
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
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single" style="width:100%" name="akuns_id">
                                            <option value="AL">01</option>
                                            @foreach ($akun as $ak)
                                                <option value="{{ $ak->id }}">({{ $ak->no_account }})
                                                    {{ $ak->name_account }}</option>
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
                                        <input class="form-control text-light" type="number" name="debet"
                                            value="{{ old('debet', $id->debet) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light" type="number" name="kredit"
                                            value="{{ old('kredit', $id->kredit) }}">
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="positive ui button">
                                                Ubah Data</button> <a class="negative ui button"
                                                href="{{ url('penyesuaian') }}">Batal</a>
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
</x-layout.app>
