<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Akun Baru</div>
                <hr>
                <form action="{{ route('save_account') }}"
                    method="POST">
                    @csrf
                    <div class="form-check">
                        <label class="form-check-label"
                            for="header_akun">
                            <input type="checkbox"
                                class="form-check-input"
                                id="header_akun"
                                name="is_header_account"
                                value="1">
                            Header Akun
                        </label>
                    </div>
                    <div class="form-group"
                        id="header_account">
                        <br>
                        <label for="no_header"
                            class="form-label">Header Nomor</label>
                        <select class="js-example-basic-single"
                            style="width:100%"
                            id="no_header"
                            name="header_account"
                            placeholder="Ketik untuk mencari">
                            @forelse ($akun_headers as $akun)
                                <option value="{{ $akun->no_account }}">{{ $akun->name_account }}
                                    ({{ $akun->no_account }})
                                </option>
                            @empty
                                <option value="">Tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nomor_akun">Nomor Akun</label>
                        <input type="text"
                            class="form-control form-control-rounded"
                            id="nomor_akun"
                            name="no_account"
                            placeholder="Masukan no akun">
                        <p style="color: red"
                            id="warning"><em>*ketik nomor akun berdasarkan header</em></p>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nama_akun">Nama Akun</label>
                        <input type="text"
                            class="form-control form-control-rounded"
                            id="nama_akun"
                            name="name_account"
                            placeholder="Masukan nama akun">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tipe_akun">Tipe Akun</label>
                        <br>
                        <select name="type_account"
                            id="tipe_akun"
                            class="form-select form-control">
                            <option value="">--Pilih tipe akun--</option>
                            <option value="1">Aktiva</option>
                            <option value="2">Pasiva</option>
                            <option value="3">Beban</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="saldo_akun">Saldo</label>
                        <input type="number"
                            class="form-control form-control-rounded"
                            id="saldo_akun"
                            name="balance"
                            placeholder="Masukan saldo"
                            value="0">
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button"
                                href="{{ route('accounts') }}">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @push('jssj')
        <script>
            $(document).ready(function() {
                $("#header_akun").click(function() {
                    if ($(this).prop("checked") == true) {
                        $("#header_account").css("display", "none");
                        $("#warning").css("display", "none");
                        $("#no_header").attr("disabled", true);
                        $("#no_header").addClass("disabled");
                        $("#no_header").val("");
                    } else if ($(this).prop("checked") == false) {
                        $("#header_account").css("display", "block");
                        $("#warning").css("display", "block");
                        $("#no_header").removeAttr("disabled");
                        $("#no_header").removeClass("disabled");
                        $("#no_header").val("");
                    }
                });
            });
        </script>
    @endpush
</x-layout.app>
