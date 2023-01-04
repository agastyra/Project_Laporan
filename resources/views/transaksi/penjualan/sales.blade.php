<x-layout.app>
    <form action="{{ route('detail.store') }}" method="post">
        @csrf
        <div class="row">
            <h3 class="header">Transaksi Penjualan</h3>
            <div class="col-lg-5 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-tittle"><i class="mdi mdi-magnify text-info icon-md"></i> Tambah Barang</h4>
                        <div class="form-group row mt-4">
                            <label class="col-sm-3 col-form-label">Kode Barang</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" placeholder="Masukkan Kode Barang" value="{{ old('no_barang') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input class="form-control text-light" placeholder="Masukkan Jumlah" value="{{ old('qty') }}" required>
                                <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi-plus"></i>
                                        Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                        <span class="d-block text-center text-sm-left mt-1 mt-sm-0 float-none float-sm-left">
                            <h5>Grand Total</h5>
                        </span>
                        <span class="float-none float-sm-right d-block mt-3 text-center">
                            <div class="display2 text-info">
                                {{-- <h2>{{ number_format($subTotal, 0,',',',') }}</h2> --}}
                            </div>
                        </span>
                        <div class="row">
                            <div class="col-sm-6 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" placeholder="" value="{{ date('Y m d') }}"
                                            readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kupon</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" placeholder="Masukkan Kupon Jika Ada">
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
    </form>
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
                                    @forelse ($items as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>{{ $item->barangs_id->name_barang }}</td>
                                        <td>Rp. {{ number_format($item->barangs_id->harga_jual, 0,',',',') }}</td>
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
                                        
                                    @endforelse
                                </tbody>
                            </table>
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
                            <form action="" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" disabled />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" type="number" disabled />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" type="number" placeholder="1" />
                                    </div>
                                </div>
                            </form>
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