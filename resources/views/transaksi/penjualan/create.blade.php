<x-layout.app>
    <div class="row">
        <h3 class="header">{{ $title }}</h3>
        <div class="col-lg-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-magnify text-info icon-md"></i> Tambah Barang</h4>
                    <form action="{{ route('detail.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name_barang" class="col-sm-3 col-form-label">Pilih Barang</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control" style="width:100%" id="barang_id" name="barang_id">
                                    <option value="-">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->name_barang }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="harga_jual" name="harga_jual" class="form-control" hidden>
                            </div>
                            <input type="text" id="no_transaction" name="no_transaction" value="{{ $no_transaction }}"
                                hidden>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control text-light" placeholder="Masukkan Jumlah"
                                    id="qty" name="qty" value="{{ old('qty') }}" required>
                                <input type="number" name="subTotal" id="subTotal" hidden>
                                <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi-cart-outline"></i>
                                        Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                    <form action="{{ route('transaksi.store') }}" method="post">
                        @csrf
                        <span class="d-block text-center text-sm-left mt-1 mt-sm-0 float-none float-sm-left">
                            <h5>Grand Total</h5>
                        </span>
                        <span class="float-none float-sm-right d-block mt-3 text-center">
                            <div class="display2 text-info">
                                <h2>Rp. {{ number_format($Gtotals, 0, ',', '.') }}</h2>
                                <input type="number" name="grand_total" id="grand_total" value="{{ $Gtotals }}" hidden>
                            </div>
                        </span>
                        <div class="row">
                            <div class="col-sm-6 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nomor</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" name="no_transaction" id="no_transaction"
                                            value="{{ $no_transaction }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="datetime" class="form-control text-dark" name="date" id="date"
                                            value="{{ $dates }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kembali</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark" placeholder="Kembali" name="kembali"
                                            id="kembali" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Bayar</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light" type="number" placeholder="Bayar"
                                            name="bayar" id="bayar">
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="mdi mdi-cart-outline"></i>
                                                Bayar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Detail Transaksi</h4>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($details as $item)
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            <td>{{ $item->barang->name_barang }}</td>
                                            <td>Rp. {{ number_format($item->barang->harga_jual, 0,',',',') }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp. {{ number_format($item->subTotal, 0,',',',') }}</td>
                                            <td>
                                                <div class="col-sm-12 mt-3">
                                                    <a href="{{ route('detail.edit', $item->id) }}"
                                                        class="btn btn-info"> <i class="mdi mdi-pencil-outline"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada Transaksi</td>
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
    </div>
    @push('jssj')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.select2').select2();
    $('#barang_id').on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url: '/getBarangData/' + data.id,
            dataType: 'json',
            success: function (response) {
                $('#harga_jual').val(response.harga_jual);
            }
        });
    });
});
    </script>
    <script>
        $(document).ready(function() {
                $('#bayar').on('input', function() {
                    var bayar = $('#bayar').val();
                    var grand_total = $('#grand_total').val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("calculate") }}',
                        data: {_token: '{{ csrf_token() }}', bayar: bayar, grand_total: grand_total},
                        success: function(result) {
                            $('#kembali').val(result.kembali);
                        }
                    });
                });
            });
    </script>
    <script>
        $(document).ready(function() {
          $('#qty').on('input', function() {
              var qty = $('#qty').val();
              var harga_jual = $('#harga_jual').val();
              $.ajax({
                  type: 'POST',
                  url: '{{ route("subCalc") }}',
                  data: {_token: '{{ csrf_token() }}', qty: qty, harga_jual: harga_jual},
                  success: function(result) {
                      $('#subTotal').val(result.subTotal);
                  }
              });
          });
      });
    </script>
    @endpush
</x-layout.app>