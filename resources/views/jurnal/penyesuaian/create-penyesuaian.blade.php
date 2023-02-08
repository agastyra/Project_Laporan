<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('simpan-penyesuaian') }}" method="POST">
                        {{ csrf_field() }}
                        {{-- <div class="form-group row mt-5">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-receipt text-success"></i>
                                Rincian</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="text" placeholder="Masukkan Rincian" />
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                Tanggal</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="date" value="{{ date('y-m-d') }}"
                                    id="date" name="date" placeholder="masukan jumlah disni" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                        Akun</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single" style="width:100%" name="akuns_id">
                                            {{-- <option value="0"> - Pilih Nama Akun - </option> --}}
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
                                    {{-- <select class="js-example-basic-single" style="width:100%" name="akuns_id">
                                        <option value="0"> - Pilih Saldo- </option>
                                        <option value="AL">Debet</option>
                                        <option value="WY">Kredit</option> --}}
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Debit
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control text-light" type="text" name="debet"
                                            id="debit" />
                                    </div>
                                    {{-- </select> --}}
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-cash text-warning"></i>
                                        Kredit</label>
                                    <div class="col-sm-9">
                                        {{-- <p id="kredit"></p> --}}
                                        <input class="form-control text-light" type="text" name="kredit"
                                            id="kredit" />
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="positive ui button">
                                                Simpan</button> <a class="negative ui button"
                                                href="{{ route('penyesuaian') }}">Batal</a>
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
    @push('jssj')
        <script>
            // $(document).ready(function() {
            //     $("#debit").keyup(function() {
            //         let deb = $("#debit").val();
            //         let kre = $("#kredit").text();

            //         if (deb > 0) {
            //             let kre = 0;
            //             $("#kredit").html(kre);
            //         }
            //     });
            // });
        </script>
    @endpush
</x-layout.app>
