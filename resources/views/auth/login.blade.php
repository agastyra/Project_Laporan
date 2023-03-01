<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toko Thrift Bismillah | Login Karyawan</title>
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
                                    <h3 class="card-title text-center mb-3">Toko Thrift Bismillah | Login Karyawan
                                        </h4>
                                </div>
                            </div>
                            <form class="form-sample mt-5"
                                method="post"
                                action="{{ route('login_user') }}">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if (session()->has('register_success'))
                                                    <div class="alert alert-info alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('register_success') }}
                                                        <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if (session()->has('loginError'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {!! session('loginError') !!}
                                                        <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    name="username"
                                                    class="form-control text-light @error('username')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="antonisiregar"
                                                    value="{{ old('username') }}"
                                                    autofocus
                                                    required />
                                                @error('username')
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
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password"
                                                    name="password"
                                                    class="form-control text-light @error('password')
                                                            is-invalid
                                                        @enderror"
                                                    placeholder="********"
                                                    required />
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
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <button type="submit"
                                            class="btn btn-primary btn-block w-100 py-3 mt-5 mb-3">Masuk</button>
                                    </div>
                                </div>
                                <p class="sign-up text-center">Belum punya akun?<a href="{{ route('register') }}">
                                        Daftar
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
