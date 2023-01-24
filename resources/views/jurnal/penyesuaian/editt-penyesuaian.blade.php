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
                                        No Akun</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single" style="width:100%" name="akuns_id">
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
                                    <label for="tipe_akun">Tipe Akun</label>
                                    <select name="type_account" id="tipe_akun"
                                        class="form-select form-control @error('id')
                                is-invalid
                                       <option value=">--Pilih tipe akun--</option>
                            @for ($i = 1; $i <= 2; $i++)
                                @if (old('id', $id->type_account) == $i)
                                    <option value="{{ $id->type_account }}"
                                        selected>
                                        @if ($id->debett == 1)
                                            Debet
                                        @elseif ($id->kredit == 2)
                                            Kredit  
                                        @endif
                                    </option>
                                @else
                                    <option value="{{ $i }}">
                                        @if ($i == 1)
                                            Debet
                                        @elseif ($i == 2)
                                           Kredit
                                        @endif
                                    </option>
                                @endif
                            @endfor
                        </select>   
                                                <button type="submit"
                                        class="positive ui button">
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
