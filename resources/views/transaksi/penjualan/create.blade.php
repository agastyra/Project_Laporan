<x-layout.app>
    <div class="row">
        <h3 class="header">JJJJ</h3>
        <div class="col-lg-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-magnify text-info icon-md"></i> Tambah Barang</h4>
                    <form action="{{ url()->current() }}" method="get">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cari Barang</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" type="search" placeholder="Cari..."
                                    name="keyword" value="{{ request('keyword') }}">
                                <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi-magnify"></i>
                                        Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($barbar->isNotEmpty())

                                    @foreach ($barbar as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>{{ $item->no_barang }}</td>
                                        <td>{{ $item->name_barang }}</td>
                                        <td>Rp. {{ number_format($item->harga_jual, 0,',',',') }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            <button type="submit" class="btn btn-icon btn-success btn-sm "
                                                data-bs-toggle="modal" data-bs-target="#modal-keranjang"><i
                                                    class="mdi mdi-cart icon-sm"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($details as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>{{ $item->barang->name_barang }}</td>
                                        <td>Rp. {{ number_format($item->barang->harga_jual, 0,',',',') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp. {{ number_format($item->subTotal, 0,',',',') }}</td>
                                        <td>
                                            <button type="submit" class="btn btn-icon btn-success btn-sm "
                                                data-bs-toggle="modal" data-bs-target="#modal-edit"><i
                                                    class="mdi mdi-pencil icon-sm"></i></button>
                                            <button type="submit" class="btn btn-icon btn-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#modal-hapus"><i
                                                    class="mdi mdi-delete icon-sm"></i></button>
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada Transaksi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                    <span class="d-block text-center text-sm-left mt-1 mt-sm-0 float-none float-sm-left">
                        <h5>Grand Total</h5>
                    </span>
                    <span class="float-none float-sm-right d-block mt-3 text-center">
                        <div class="display2 text-info">
                            <h2>{{ number_format($Gtotals, 0,',',',') }}</h2>
                        </div>
                    </span>
                    <div class="row">
                        <div class="col-sm-6 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" placeholder="" value="{{ $transCode }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kupon</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" placeholder="" value="{{ $dates }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kembali</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" placeholder="" value="" disabled />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bayar</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-light" type="number" placeholder="Bayar">
                                    <div class="col-sm-12 mt-3">
                                        <button type="submit" class="btn btn-success"><i
                                                class="mdi mdi-cart-outline"></i>
                                            Bayar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-keranjang" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Opsi Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('detail.store') }}" method="post">
                            @csrf
                            <input class="form-control text-dark" id="trans_code" name="trans_code"
                                value="{{ $transCode }}" hidden />
                            @foreach ($barbar as $barang)
                            <input class="form-control text-dark" id="barang_id" name="barang_id"
                                value="{{ $barang->id }}" hidden />
                            <div class="form-group row">
                                <label for="name_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" id="name_barang" name="name_barang"
                                        value="{{ $barang->name_barang }}" disabled />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_jual" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" type="number" id="harga_jual"
                                        name="harga_jual" value="{{ number_format($barang->harga_jual, 0, ',', '.') }}"
                                        disabled />
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group row">
                                <label for="qty" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark" type="number" id="qty" name="qty"
                                        value="{{ old('qty') }}">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="mdi mdi-window-close"></i> Tutup</button>
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-floppy"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                                <input class="form-control text-dark" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input class="form-control text-dark" type="number" placeholder="1" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="mdi mdi-window-close"></i> Tutup</button>
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-floppy"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Hapus Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="display4">
                            <h4>Apakah Barang Ingin dihapus?</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="mdi mdi-window-close"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
@push('jssj')
<script>
    var modalKr = document.getElementById('modal-keranjang');
        
            modalEd.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  let button = event.relatedTarget;
                  // Extract info from data-bs-* attributes
                  let recipient = button.getAttribute('data-bs-whatever');
        
                // Use above variables to manipulate the DOM
            });
</script>
<script>
    var modalEd = document.getElementById('modal-edit');
        
            modalEd.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  let button = event.relatedTarget;
                  // Extract info from data-bs-* attributes
                  let recipient = button.getAttribute('data-bs-whatever');
        
                // Use above variables to manipulate the DOM
            });
</script>
<script>
    var modalHp = document.getElementById('modal-hapus');
        
            modalHp.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  let button = event.relatedTarget;
                  // Extract info from data-bs-* attributes
                  let recipient = button.getAttribute('data-bs-whatever');
        
                // Use above variables to manipulate the DOM
            });
</script>
@endpush