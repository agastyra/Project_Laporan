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
                                    @forelse ($bukti_kas_keluars as $bkk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bkk->no_transaction }}</td>
                                            <td>{{ $bkk->tanggal }}</td>
                                            <td>{{ $bkk->description }}</td>
                                            @if ($bkk->akun_amount)
                                                <td>{{ number_format($bkk->akun_amount, 0, ',', '.') }}</td>
                                            @else
                                                <td>{{ number_format($bkk->transaksi_pembelian->grand_total, 0, ',', '.') }}
                                                </td>
                                            @endif
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
                                                        type="submit"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Tidak ada data</td>
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
</x-layout.app>
