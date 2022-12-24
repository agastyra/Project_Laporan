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
                                    <th>Nama Barang</th>
                                    <th>Stock</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Pricc</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td>Kaos Gucci</td>
                                    <td> $ 77.99 </td>
                                    <td>1</td>
                                    <td> $ 77.99 </td>
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


</x-layout.app>
