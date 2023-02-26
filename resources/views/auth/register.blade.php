<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toko Thrift Bismillah | Pendaftaran Karyawan</title>
    <meta name="csrf-token"
        content="{{ csrf_token() }}">
    <!-- plugins:css -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/style.css') }}">
    <!-- Layout styles -->
    <!-- End layout styles -->
    <link rel="shortcut icon"
        href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-10 mx-auto">
                        <div class="card-body px-5 py-5">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/favicon.png') }}"
                                            alt="Logo"
                                            class="m-auto mb-5">
                                    </div>
                                    <h3 class="card-title text-center mb-3">Toko Thrift Bismillah | Pendaftaran Karyawan
                                        Baru
                                        </h4>
                                </div>
                            </div>
                            <form class="form-sample"
                                method="post"
                                action="{{ route('register_user') }}">
                                @csrf
                                <p class="card-description">Autentikasi</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    name="username"
                                                    class="form-control text-light @error('username')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="antonisiregar"
                                                    value="{{ old('username') }}" />
                                                @error('username')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password"
                                                    name="password"
                                                    class="form-control text-light @error('password')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="********" />
                                                @error('password')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-description"> Personal info </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Depan</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    name="nama_depan"
                                                    class="form-control text-light @error('nama_depan')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="Antoni"
                                                    value="{{ old('nama_depan') }}" />
                                                @error('username')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Belakang</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    name="nama_belakang"
                                                    class="form-control text-light @error('nama_belakang')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="Siregar"
                                                    value="{{ old('nama_belakang') }}" />
                                                @error('nama_belakang')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select
                                                    class="form-control text-light form-select @error('jenis-kelamin')
                                                        is-invalid
                                                    @enderror"
                                                    name="jenis_kelamin">
                                                    <option value=""> -- </option>
                                                    @for ($i = 1; $i <= 2; $i++)
                                                        @if (old('jenis_kelamin') == $i)
                                                            <option value="{{ old('jenis_kelamin') }}"
                                                                selected>
                                                                @if ($i == 1)
                                                                    Laki - Laki
                                                                @elseif ($i == 2)
                                                                    Perempuan
                                                                @endif
                                                            </option>
                                                        @else
                                                            <option value="{{ $i }}">
                                                                @if ($i == 1)
                                                                    Laki - Laki
                                                                @elseif ($i == 2)
                                                                    Perempuan
                                                                @endif
                                                            </option>
                                                        @endif
                                                    @endfor
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-9">
                                                <input
                                                    class="form-control text-light @error('ttl')
                                                        is-invalid
                                                    @enderror"
                                                    placeholder="dd/mm/yyyy"
                                                    type="date"
                                                    name="ttl"
                                                    value="{{ old('ttl') }}" />
                                                @error('ttl')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jabatan</label>
                                            <div class="col-sm-9">
                                                <select
                                                    class="form-control form-select text-light @error('jabatan')
                                                        is-invalid
                                                    @enderror"
                                                    name="jabatan">
                                                    <option value=""> -- </option>
                                                    @for ($i = 1; $i <= 3; $i++)
                                                        @if (old('jabatan') == $i)
                                                            <option value="{{ old('jabatan') }}"
                                                                selected>
                                                                @if ($i == 1)
                                                                    Kasir
                                                                @elseif ($i == 2)
                                                                    Akuntan
                                                                @elseif ($i == 3)
                                                                    Direktur
                                                                @endif
                                                            </option>
                                                        @else
                                                            <option value="{{ $i }}">
                                                                @if ($i == 1)
                                                                    Kasir
                                                                @elseif ($i == 2)
                                                                    Akuntan
                                                                @elseif ($i == 3)
                                                                    Direktur
                                                                @endif
                                                            </option>
                                                        @endif
                                                    @endfor
                                                </select>
                                                @error('jabatan')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label text-light">
                                                        <input type="radio"
                                                            class="form-check-input @error('status')
                                                                    is-invalid
                                                                @enderror"
                                                            name="status"
                                                            id="membershipRadios1"
                                                            value="1"
                                                            checked> Magang
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                    <label class="form-check-label text-light">
                                                        <input type="radio"
                                                            class="form-check-input"
                                                            name="status"
                                                            id="membershipRadios2"
                                                            value="2"
                                                            @if (old('status') == 2) checked @endif> Pegawai
                                                        Tetap </label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('status')
                                            <div id="validationServerUsernameFeedback"
                                                class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <p class="card-description"> Alamat </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control text-light @error('alamat_jalan')
                                                            is-invalid
                                                        @enderror"
                                                    name="alamat_jalan"
                                                    placeholder="JL. Jakarta No. 1"
                                                    value="{{ old('alamat_jalan') }}" />
                                                @error('alamat_jalan')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Provinsi</label>
                                            <div class="col-sm-9">
                                                <select name="alamat_provinsi"
                                                    id="alamat_provinsi_address"
                                                    class="form-control form-select text-light @error('alamat_provinsi')
                                                            is-invalid
                                                        @enderror">
                                                    <option value=""> -- </option>
                                                    @foreach ($provinsis as $provinsi)
                                                        <option value="{{ $provinsi['id'] }}">
                                                            {{ $provinsi['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('alamat_provinsi')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kota / Kabupaten</label>
                                            <div class="col-sm-9">
                                                <select name="alamat_kota_kabupaten"
                                                    id="alamat_kota_kabupaten_address"
                                                    class="form-control form-select text-light @error('alamat_kota_kabupaten')
                                                            is-invalid
                                                        @enderror">
                                                    <option value=""> -- </option>
                                                </select>
                                                @error('alamat_kota_kabupaten')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                                            <div class="col-sm-9">
                                                <select name="alamat_kecamatan"
                                                    id="alamat_kecamatan_address"
                                                    class="form-control form-select text-light @error('alamat_kecamatan')
                                                            is-invalid
                                                        @enderror">
                                                    <option value=""> -- </option>
                                                </select>
                                                @error('alamat_kecamatan')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kelurahan</label>
                                            <div class="col-sm-9">
                                                <select name="alamat_kelurahan"
                                                    id="alamat_kelurahan_address"
                                                    class="form-control form-select text-light @error('alamat_kelurahan')
                                                            is-invalid
                                                        @enderror">
                                                    <option value=""> -- </option>
                                                </select>
                                                @error('alamat_kelurahan')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kode pos</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control text-light @error('alamat_kode_pos')
                                                            is-invalid
                                                        @enderror"
                                                    name="alamat_kode_pos"
                                                    placeholder="65131"
                                                    value="{{ old('alamat_kode_pos') }}" />
                                                @error('alamat_kode_pos')
                                                    <div id="validationServerUsernameFeedback"
                                                        class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit"
                                            class="btn btn-primary btn-block w-100 py-3 mt-5 mb-3">Daftar</button>
                                    </div>
                                </div>
                                <p class="sign-up text-center">Sudah punya akun?<a href="#"> Masuk
                                        disini</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/register/index.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
</body>

</html>
