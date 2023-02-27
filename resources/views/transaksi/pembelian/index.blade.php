<x-layout.app>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-barcode-scan"></i>
                        Data Pembelian
                    </h5>
                    <div align="right">
                        <a class="positive ui button" href="{{ route('create_purchase') }}">Tambah</a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-md">#</th>
                                    <th scope="col-md">No Transaksi</th>
                                    <th scope="col-md">Tanggal</th>
                                    <th scope="col-md">Total</th>
                                    <th scope="col-md">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->no_transaction }}</td>
                                    <td>{{ $purchase->date }}</td>
                                    <td>{{ number_format($purchase->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('detail_purchase', $purchase->no_transaction) }}"
                                            class="text-decoration-none link-light badge bg-primary border-0">
                                            <i class="mdi mdi-file-document-edit-outline"></i>
                                        </a>
                                        <form action="{{ route('delete_purchase', $purchase->no_transaction) }}"
                                            method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0" type="submit"
                                                onclick="return confirm('Apakah anda yakin ?')">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Tidak ada data</td>
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
