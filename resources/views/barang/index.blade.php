<x-layout.app>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Barang </h3>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Barang
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Barang</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end mb-3">
                            <a href="#" wire:click.prevent="tambahBrg" class="btn btn-info btn-sm mr-1"><i
                                    class="fa fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="list-barang" class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Barang</th>
                                    <th>Name Barang</th>
                                    <th>Stock</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>BRG01</td>
                                    <td>Tas Guci</td>
                                    <td>4</td>
                                    <td>300000</td>
                                    <td>400000 </td>
                                    <td>
                                        <button type="submit" class="btn btn-icon btn-success btn-sm "
                                            data-bs-toggle="modal" data-bs-target="#modal-edit"><i
                                                class="mdi mdi-pencil icon-sm"></i></button>
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modal-hapus"><i
                                                class="mdi mdi-delete icon-sm"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
                                <input class="form-control text-white" type="number" placeholder="1" />
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
        var modalEd = document.getElementById('modal-edit');

        modalEd.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');

            // Use above variables to manipulate the DOM
        });
    </script>
    <script>
        var modalHp = document.getElementById('modal-hapus');

        modalHp.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');

            // Use above variables to manipulate the DOM
        });
    </script>
@endpush
