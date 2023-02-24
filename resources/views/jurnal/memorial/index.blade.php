<x-layout.app>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table Memorial</h5>
                    <div align="right">
                        <a class="positive ui button"
                            href="{{ route('create_memorial') }}">Tambah</a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-md">#</th>
                                    <th scope="col-md">Tanggal</th>
                                    <th scope="col-md">No Transaksi</th>
                                    <th scope="col-md">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1/1/2019</td>
                                    <td>JM-001</td>
                                    <td>
                                        <a href=""
                                            class="text-decoration-none link-light badge bg-primary border-0">
                                            <i class="mdi mdi-file-document-edit-outline"></i>
                                        </a>
                                        <form action=""
                                            method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Apakah anda yakin ?')">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
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
