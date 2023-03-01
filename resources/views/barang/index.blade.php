<x-layout.app>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Barang </h3>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">
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
                            <a class="positive ui button"
                                href="{{ route('tambah_barang') }}">Tambah</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="list-barang"
                            class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>No.</th> -->
                                    <th>No Barang</th>
                                    <th>Name Barang</th>
                                    <th>Stock</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($barangs as $barang)
                                    <tr>
                                        <!-- <td>{{ $barang->id }}</td> -->
                                        <td>{{ $barang->no_barang }}</td>
                                        <td>{{ $barang->name_barang }}</td>
                                        <td>{{ $barang->stok }}</td>
                                        <td>{{ $barang->harga_beli }}</td>
                                        <td>{{ $barang->harga_jual }} </td>
                                        <td>
                                            <!-- <button type="submit" class="btn btn-icon btn-success btn-sm "
                                            data-bs-toggle="modal" data-bs-target="#modal-edit"><i
                                                class="mdi mdi-pencil icon-sm"></i></button>
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modal-hapus"><i
                                                class="mdi mdi-delete icon-sm"></i></button> -->


                                            <a href="{{ route('edit_barang', $barang->no_barang) }}"
                                                class="btn btn-icon btn-success btn-sm "><i
                                                    class="mdi mdi-pencil icon-sm"></i></a>

                                            @can('cashier.tetap')
                                                <form action="{{ route('hapus_barang', $barang->no_barang) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                            <!-- <button type="button" class="btn btn-icon btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modal-hapus"><i
                                                class="mdi mdi-delete icon-sm"></i></button> -->
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- <tr> -->


                                <!-- </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- modalhapus -->
    <div class="modal fade"
        id="modal-hapus"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="modalTitleId">Hapus Barang</h5>
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>




                <form action="{{ route('hapus_barang', $barang->no_barang) }}"
                    method="POST">
                    @method('Delete')
                    @csrf


                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="display4">
                                <h4>Apakah Barang Ingin dihapus?</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"><i class="mdi mdi-window-close"></i> Batal</button>
                        <button type="submit"
                            class="btn btn-success"><i class="mdi mdi-check"></i>
                            Hapus</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('jssj')
        <script>
            var modalHp = document.getElementById('modal-hapus');

            modalHp.
            addEvent
            Listener
                ('show.bs.modal ', function(event) {

                    // Button that triggered the modal
                    let button = event.relatedTarget;
                    // Extract info from data-bs-* attributes
                    let recipient = button.getAttribute('data-bs-whatever');

                    // Use above variables to manipulate the DOM
                });
        </script>
    @endpush

</x-layout.app>
