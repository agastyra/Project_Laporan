<x-layout.app>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table Account</h5>
                    <div align="right">
                        <a class="positive ui button"
                            href="{{ route('create_purchase') }}">Tambah</a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-md">No Akun</th>
                                    <th scope="col-md">Nama Akun</th>
                                    <th scope="col-md">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>
                                        <a href=""
                                            class="text-decoration-none link-light badge bg-primary border-0">
                                            <i class="mdi mdi-file-document-edit-outline"></i>
                                        </a>
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Apakah anda yakin ?')">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
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
