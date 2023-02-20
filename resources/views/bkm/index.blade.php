<x-layout.app>
    <div class="row">
        <h3 class="card-title"> Bukti Kas Masuk</h3>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('bkm.create') }}" class="btn btn-info mb-3"><i class="mdi mdi-plus"></i> Tambah BKM</a>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @foreach ($bkmtotals as $bulTotal)
                                <div class="col-sm-6">
                                    <h5>Bulan: {{ $bulTotal->bulan }}</h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-3"><h5>Total:</h5></div>
                                        <div class="col-sm-9">
                                            <div class="display-5 text-info">
                                                Rp. {{ number_format($bulTotal->totals, 0, ',', '.') }}
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>No.BKM</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bkm as $mas)
                                <tr>
                                    <td>{{ $mas->no_bkm }}</td>
                                    <td>{{ $mas->tanggal }}</td>
                                    <td>{{ $mas->description }}</td>
                                    <td>{{ $mas->total }}</td>
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