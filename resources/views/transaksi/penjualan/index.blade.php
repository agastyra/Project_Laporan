<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10 mt-2">
                            <div class="card-title">
                                <h4><i class="mdi mdi-barcode-scan text-danger icon-md"></i> {{ $title }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <a href="{{ route('transaksi.create') }}" class="btn btn-info mb-3"><i
                                    class="mdi mdi-plus"></i> Tambah Transaksi</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Grand Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $trans)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trans->no_transaction }}</td>
                                    <td>{{ $trans->date }}</td>
                                    <td>{{ $trans->total }}</td>
                                    <td>
                                        <a href="{{route('printpen', $trans->no_transaction)}}"
                                            class="btn btn-behance"><i class="mdi mdi-printer"></i></a>
                                        <a href="" class="btn btn-danger"> <i class="mdi mdi-trash-can"></i></a>
                                    </td>
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