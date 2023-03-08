<div>
    <nav class="sidebar sidebar-offcanvas"
        id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo"
                href="/">
                <img src="{{ asset('assets/images/logo.svg') }}"
                    alt="logo" />
            </a>
            <a class="sidebar-brand brand-logo-mini"
                href="/"><img src="{{ asset('assets/images/favicon.png') }}"
                    alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle "
                                src="{{ asset('assets/images/faces/face15.jpg') }}"
                                alt="">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal">{{ auth()->user()->nama_depan }}</h5>
                            <span class="d-block mt-1">
                                @if (auth()->user()->jabatan == 1)
                                    Kasir
                                @elseif (auth()->user()->jabatan == 2)
                                    Akuntan
                                @elseif (auth()->user()->jabatan == 3)
                                    Direktur
                                @endif
                            </span>
                            <span class="d-block">
                                @if (auth()->user()->status == 1)
                                    Pegawai magang
                                @else
                                    Pegawai Tetap
                                @endif
                            </span>
                        </div>
                    </div>
                    <a href="#"
                        id="profile-dropdown"
                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                        aria-labelledby="profile-dropdown">
                        <a href="#"
                            class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-primary"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#"
                            class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-onepassword  text-info"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#"
                            class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-calendar-today text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link"
                    href="/">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <!-- <li class="nav-item menu-items">
                <a class="nav-link"
                    href="{{ route('accounts') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Akun</span>
                </a>
            </li> -->

            {{-- Cashier --}}
            @can('cashier')
                <li class="nav-item menu-items">
                    <a class="nav-link"
                        href="{{ route('barang') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Barang</span>
                    </a>
                </li>
            @endcan

            <!-- <li class="nav-item menu-items">
                <a class="nav-link"
                    href="/penyesuaian">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="menu-title">Jurnal Penyesuaian</span>
                </a>
            </li> -->

            <!-- <li class="nav-item menu-items">
                <a class="nav-link"
                    href="/memo">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Jurnal Memorial</span>
                </a>
            </li> -->
            <!-- <li class="nav-item menu-items">

                <a class="nav-link"
                    href="">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>

                    <span class="menu-title">Bukti</span>
                </a>
            </li> -->

            {{-- Accounting --}}
            @can('office')
                <li class="nav-item menu-items">
                    <a class="nav-link"
                        data-bs-toggle="collapse"
                        href="#accounting"
                        aria-expanded="false"
                        aria-controls="accounting">
                        <span class="menu-icon">
                            <i class="mdi mdi mdi-margin"></i>
                        </span>
                        <span class="menu-title">Accounting</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse"
                        id="accounting">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('accounts') }}"> Akun </a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('cash_out') }}"> Bukti Kas Keluar
                                </a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('bkm.index') }}"> Bukti Kas Masuk
                                </a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('memorial') }}"> Jurnal Umum </a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="/penyesuaian"> Jurnal penyesuaian
                                </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link"
                        data-bs-toggle="collapse"
                        href="#report"
                        aria-expanded="false"
                        aria-controls="report">
                        <span class="menu-icon">
                            <i class="mdi mdi mdi mdi-clipboard-text"></i>
                        </span>
                        <span class="menu-title">Report</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse"
                        id="report">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('ledger') }}"> Buku Besar </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            {{-- Cashier --}}
            @can('cashier')
                <li class="nav-item menu-items">
                    <a class="nav-link"
                        data-bs-toggle="collapse"
                        href="#ui-basic"
                        aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-bank-transfer"></i>
                        </span>
                        <span class="menu-title">Transaksi</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse"
                        id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('transaksi.index') }}">Penjualan</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('purchase') }}">Pembelian</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

        </ul>
    </nav>
</div>
