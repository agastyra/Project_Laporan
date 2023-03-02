<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">{{ $akun->name_account }} ({{ $akun->no_account }})</div>
                <hr>
                <form action="{{ route('update_account', $akun->no_account) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="form-check">
                        <label class="form-check-label" for="header_akun">
                            <input type="checkbox" class="form-check-input" id="header_akun" name="is_header_account"
                                value="1" @if ($akun->is_header_account) checked
                            @else @endif>
                            Header Akun
                        </label>
                    </div>
                    <div class="form-group" id="header_account">
                        <br>
                        <label for="no_header" class="form-label">Header Nomor</label>
                        <select class="js-example-basic-single" style="width:100%" id="no_header" name="header_account"
                            placeholder="Ketik untuk mencari">
                            @forelse ($akun_headers as $akun_header)
                            @if (old('header_account', $akun_header->no_account) == $akun->header_account)
                            <option value="{{ $akun_header->no_account }}" selected>{{ $akun_header->name_account }}
                                ({{ $akun_header->no_account }})
                            </option>
                            @else
                            <option value="{{ $akun_header->no_account }}">{{ $akun_header->name_account }}
                                ({{ $akun_header->no_account }})
                            </option>
                            @endif
                            @empty
                            <option value="">Tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nomor_akun">Nomor Akun</label>
                        <input type="text" class="form-control form-control-rounded @error('no_account')
                                is-invalid
                            @enderror" id="nomor_akun" name="no_account" placeholder="Masukan no akun"
                            value="{{ old('no_account', $akun->no_account) }}">
                        <p style="color: red" id="warning"><em>*ketik nomor akun berdasarkan header</em></p>
                        @error('no_account')
                        <p style="color: red" id="warning"><em>{{ $message }}</em></p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nama_akun">Nama Akun</label>
                        <input type="text" class="form-control form-control-rounded @error('name_account')
                                is-invalid
                            @enderror" id="nama_akun" name="name_account" placeholder="Masukan nama akun"
                            value="{{ old('name_account', $akun->name_account) }}">
                        @error('name_account')
                        <p style="color: red" id="warning"><em>{{ $message }}</em></p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tipe_akun">Tipe Akun</label>
                        <br>
                        <select name="type_account" id="tipe_akun" class="form-select form-control @error('type_account')
                                is-invalid
                            @enderror">
                            <option value="">--Pilih tipe akun--</option>
                            @for ($i = 1; $i <= 3; $i++) @if (old('type_account', $akun->type_account) == $i)
                                <option value="{{ $akun->type_account }}" selected>
                                    @if ($akun->type_account == 1)
                                    Aktiva
                                    @elseif ($akun->type_account == 2)
                                    Pasiva
                                    @elseif ($akun->type_account == 3)
                                    Beban
                                    @endif
                                </option>
                                @else
                                <option value="{{ $i }}">
                                    @if ($i == 1)
                                    Aktiva
                                    @elseif ($i == 2)
                                    Pasiva
                                    @elseif ($i == 3)
                                    Beban
                                    @endif
                                </option>
                                @endif
                                @endfor
                        </select>
                        @error('type_account')
                        <p style="color: red" id="warning"><em>{{ $message }}</em></p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="saldo_akun">Saldo</label>
                        <input type="number" class="form-control form-control-rounded" id="saldo_akun" name="balance"
                            placeholder="Masukan saldo" value="{{ old('balance', $akun->balance) }}">
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button" href="{{ route('accounts') }}">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @push('jssj')
    <script>
    $(document).ready(function() {
        if ($("#header_akun").prop("checked") == true) {
            $("#header_account").css("display", "none");
            $("#warning").css("display", "none");
            $("#no_header").attr("disabled", true);
            $("#no_header").addClass("disabled");
            $("#no_header").val("");
        } else if ($("#header_akun").prop("checked") == false) {
            $("#header_account").css("display", "block");
            $("#warning").css("display", "block");
            $("#no_header").removeAttr("disabled");
            $("#no_header").removeClass("disabled");
            $("#no_header").val("");
        }

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
