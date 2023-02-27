<x-layout.app>
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="card-title"><i class="mdi mdi-cash text-danger icon-md"></i> Bukti Kas Masuk</h4>
                        </div>

                        <div class="col-md-3">
                            <form method="GET">
                                <div class="form-group row">
                                    <label for="selectedMonth" class="col-sm-4">Pilih Bulan:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control text-light" name="selectedMonth" id="selectedMonth">
                                            <option value="">Pilih Bulan</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1" align="right">
                            <a href="{{ route('bkm.create') }}" class="btn btn-warning mt-1"><i
                                    class="mdi mdi-plus"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="bkm-table">
                            <thead>
                                <tr>
                                    <th>No.BKM</th>
                                    <th>Referensi</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('bkm/table', compact('bkm'))
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('jssj')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
    $(document).ready(function() {
        $('#selectedMonth').on('change', function() {
            var selectedMonth = $(this).val();

            $.ajax({
                url: '{{ route("bkm.index") }}',
                data: {
                    selectedMonth: selectedMonth
                },
                success: function(response) {
                    $('#bkm-table tbody').html(response);
                }
            });
        });
    });
    </script>
    @endpush
</x-layout.app>
