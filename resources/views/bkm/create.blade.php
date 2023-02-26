<x-layout.app>
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><i class="mdi mdi-square-inc-cash text-warning icon-md"></i> Bukti Kas Masuk</h4>
        <form action="{{ route('bkm.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="exampleInputName1">No. BKM</label>
            <input type="text" class="form-control text-dark" id="no_bkm" name="no_bkm" value="{{ $no_bkm }}" readonly>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 col-form-label">Pilih Transaksi</label>
            <select class="form-control text-light" style="width:100%" id="penjualan_memorial"
              name="penjualan_memorial">
              <option value="">Pilih Transaksi</option>
              <option value="trans">Transaksi Penjualan</option>
              <option value="memo">Jurnal Memorial</option>
            </select>
          </div>

          <div class="trans_fields" id="trans_fields" style="display: none">
            <div class="form-group">
              <label for="" class="col-sm-3 col-form-label">Pilih Transaksi</label>
              <select class="select2 form-control" style="width:100%" id="transaksi_penjualan_id"
                name="transaksi_penjualan_id">
                <option value="0">Pilih Nota</option>
                @foreach ($transaksi as $trans)
                <option value="{{ $trans->id }}">{{ $trans->no_transaction }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="memo_fields" id="memo_fields" style="display: none">
            <div class="form-group">
              <label for="" class="col-sm-3 col-form-label">Pilih Transaksi</label>
              <select class="select2 form-control" style="width:100%" id="jurnal_memorial_id" name="jurnal_memorial_id">
                <option value="0">Pilih Nota</option>
                @foreach ($memo as $rial)
                <option value="{{ $rial->id }}">{{ $rial->transaction_no }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword4">Debet</label>
              <input type="number" class="form-control text-dark" id="debet" name="debet" placeholder="Jumlah" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword4">Kredit</label>
              <input type="number" class="form-control text-dark" id="kredit" name="kredit" placeholder="Jumlah"
                readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Tanggal</label>
            <input type="date" class="form-control text-dark" id="tanggal" name="tanggal" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Jumlah</label>
            <input type="number" class="form-control text-dark" id="total" name="total" placeholder="Jumlah" readonly>
          </div>
          <div class="form-group">
            <label for="exampleTextarea1">Keterangan</label>
            <textarea class="form-control text-light" id="description" name="description" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-dark">Cancel</button>
        </form>
      </div>
    </div>
  </div>
  @push('jssj')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
    $('.select2').select2();
    $('#transaksi_penjualan_id').on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url: '/getTransData/' + data.id,
            dataType: 'json',
            success: function (response) {
                $('#tanggal').val(response.tanggal);
                $('#total').val(response.total);
            }
        });
    });
});
  </script>
  <script>
    $(document).ready(function() {
    $('.select2').select2();
    $('#jurnal_memorial_id').on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            url: '/getMemoData/' + data.id,
            dataType: 'json',
            success: function (response) {
                $('#tanggal').val(response.tanggal);
                $('#debet').val(response.debet);
                $('#kredit').val(response.kredit);
            }
        });
    });
});
  </script>
  <script>
    $(document).ready(function(){
        // Show/hide fields on page load
        $('#penjualan_memorial').change();
        
        // Show/hide fields on select change
        $('#penjualan_memorial').change(function(){
            if ($(this).val() == 'trans') {
                $('#trans_fields').show();
                $('#memo_fields').hide();
            } else if ($(this).val() == 'memo') {
                $('#memo_fields').show();
                $('#trans_fields').hide();
            } else {
                $('#trans_fields').hide();
                $('#memo_fields').hide();
            }
        });
    });
  </script>
  <script>
    $(document).ready(function() {
  var debet = 0;
  var kredit = 0;
  var memoId = 0;

  function calculateTotal() {
    var total = debet - kredit;
    $('#total').val(total);
  }

  // Call the `getMemoData` function to retrieve the memo data
  function getMemoData() {
    $.getJSON('/getMemoData/' + memoId, function(data) {
      debet = data.debet;
      kredit = data.kredit;
      $('#debet').val(debet);
      $('#kredit').val(kredit);
      calculateTotal();
    });
  }

  // Replace `id` with the ID of the memo received from `getMemoData`
  $(document).ready(function() {
    $('.select2').select2();
    $('#jurnal_memorial_id').on('select2:select', function (e) {
        var data = e.params.data;
        memoId = data.id;
        getMemoData();
    });
  });

  $('#debet').on('input', function() {
    debet = $('#debet').val();
    calculateTotal();
  });

  $('#kredit').on('input', function() {
    kredit = $('#kredit').val();
    calculateTotal();
  });
});

  </script>
  @endpush
</x-layout.app>