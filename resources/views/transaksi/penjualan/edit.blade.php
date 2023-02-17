<x-layout.app>
   <div class="row">
      <div class="col-lg-12 grid-margin">
         <div class="card">
            <div class="card-body">
               {{-- <h4 class="card-tittle"><i class="mdi mdi-cash text-primary icon-md"></i> Edit</h4> --}}
               <div class="col-sm-12-mt-5">
                  <form action="{{ route('detail.destroy', $detail->id) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger"><i class="mdi mdi-delete"> Hapus detail</i></button>
                  </form>
               </div>
               <form action="{{ route('detail.update', $detail->id) }}" method="post">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-sm-6 mt-5">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Nama Barang</label>
                           <div class="col-sm-9">
                              <input class="form-control text-dark" value="{{ $detail->barang->name_barang }}" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Kode Barang</label>
                           <div class="col-sm-9">
                              <input class="form-control text-dark" value="{{ $detail->barang->no_barang }}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 mt-5">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Harga</label>
                           <div class="col-sm-9">
                              <input class="form-control text-dark" name="subTotal" id="subTotal"
                                 value="{{ old('subTotal', $detail->subTotal) }}" readonly>
                              <input type="number" name="harga_jual" id="harga_jual"
                                 value="{{ $detail->barang->harga_jual }}" hidden>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Jumlah</label>
                           <div class="col-sm-9">
                              <input class="form-control text-light" type="number" name="qty" id="qty"
                                 value="{{ old('qty',$detail->qty) }}">
                              <div class="col-sm-12 mt-3">
                                 <button type="submit" class="btn btn-info"><i class="mdi mdi-check"></i>
                                    Simpan</button>
                                 <a href="{{ route('transaksi.create', $detail->no_transaction) }}"
                                    class="btn btn-warning"><i class="mdi mdi-window-close"></i> Batal</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   @push('jssj')
   <script>
      $(document).ready(function() {
          $('#qty').on('input', function() {
              var qty = $('#qty').val();
              var harga_jual = $('#harga_jual').val();
              $.ajax({
                  type: 'POST',
                  url: '{{ route("detail.calc") }}',
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