<x-layout.app>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Table Cash Out</h5>
                        <div align="right">
                            <a class="positive ui button"
                                href="{{ route('create_cash_out') }}">Tambah</a>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-md">#</th>
                                        <th scope="col-md">No Transaksi</th>
                                        <th scope="col-md">Tanggal</th>
                                        <th scope="col-md">Deskripsi</th>
                                        <th scope="col-md">Total</th>
                                        <th scope="col-md">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
