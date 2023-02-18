<x-layout.app>
    <div class="row">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-info mb-3"><i class="mdi mdi-plus"></i> Tambah Transaksi</a>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $trans)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trans->no_transaction }}</td>
                                    <td>{{ $trans->date }}</td>
                                    <td>{{ $trans->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada Transaksi</td>
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