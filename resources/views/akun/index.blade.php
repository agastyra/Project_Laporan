<x-layout.app>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table Account</h5>
                    <div align="right">
                        <a class="positive ui button"
                            href="{{ route('create_account') }}">Tambah</a>
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
                                @forelse ($akuns as $akun)
                                    <tr>
                                        <td>{{ $akun->no_account }}</td>
                                        <td>{{ $akun->name_account }}</td>
                                        <td>
                                            <a href="{{ route('edit_account', $akun->no_account) }}"
                                                class="link-primary text-decoration-none fs-5">
                                                <i class="mdi mdi-file-document-edit-outline"></i>
                                            </a>
                                            <a href="{{ route('delete_account', $akun->no_account) }}"
                                                class="link-danger text-decoration-none fs-5">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
