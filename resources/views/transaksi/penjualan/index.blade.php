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
                            <a href="{{ route('transaksi.create') }}" class="btn btn-info mb-3"><i class="mdi mdi-plus"></i> Tambah Transaksi</a>
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
                                    <th>Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $trans)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trans->no_transaction }}</td>
                                    <td>{{ $trans->date }}</td>
                                    <td>{{ $trans->total }}</td>
                                    <td><form action="{{ route('sales.print') }}" method="get" target="_blank">
                                        @csrf
                                        <input type="text" name="no_transaction" id="no_transaction" value="{{ $trans->no_transaction }}" hidden>
                                        <button type="submit" class="btn btn-secondary btn-icon"><i class="mdi mdi-printer"></i></button>
                                    </form></td>
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