<x-layout.app>
    <div class="row">
        <h3 class="header">Transaksi Pembelian</h3>
        <div class="col-lg-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-magnify text-info icon-md"></i> Cari Barang</h4>
                    <div class="form-group">
                        <select class="js-example-basic-single"
                            style="width:100%"
                            name="keyBarang"
                            id="keyBarang">
                            <option value="">-</option>
                            @forelse ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->name_barang }}</option>
                            @empty
                                <option value="">-- Tidak ada data --</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-buffer text-success icon-md"></i> Hasil Pencarian</h4>
                    <div class="table-responsive">
                        <form id="form-barang">
                            @csrf
                            <input type="hidden"
                                name="barangs_id"
                                id="barangs_id">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Keranjang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="no_barang">-</td>
                                        <td id="name_barang">-</td>
                                        <td id="harga_beli">-</td>
                                        <td>
                                            <input class="form-control text-light"
                                                type="number"
                                                name="qty"
                                                id="qty"
                                                required>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-success btn-sm"
                                                type="submit">
                                                <i class="mdi mdi-cart"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="mdi mdi-cash text-primary icon-md"></i> Pembayaran</h4>
                    <form action="{{ route('save_purchase') }}"
                        method="post"
                        id="form_transaksi">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9 text-dark">
                                        <input class="form-control text-dark disabled"
                                            value="{{ date('Y-m-d') }}"
                                            id="date_transaksi"
                                            name="date"
                                            type="date"
                                            readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Vendor</label>
                                    <div class="col-sm-9">
                                        <select name="vendor"
                                            id="vendor"
                                            class="form-control form-select text-light">
                                            <option value="Risky">Risky</option>
                                            <option value="Mukhlas">Mukhlas</option>
                                            <option value="Mukhlis">Mukhlis</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Diskon <span
                                            id="persen_diskon"></span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            id="diskon"
                                            name="diskon"
                                            value="0"
                                            readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grand Total</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            id="grand_total"
                                            name="grand_total"
                                            placeholder="Total..."
                                            readonly />
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Bayar</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-light disabled"
                                            type="number"
                                            id="bayar"
                                            name="bayar"
                                            placeholder="0" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kembali</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            value="0"
                                            id="kembali"
                                            name="kembali"
                                            readonly />
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit"
                                                class="btn btn-success"><i class="mdi mdi-cart-outline"></i>
                                                Simpan</button>
                                            <button type="submit"
                                                class="btn btn-info"><i class="mdi mdi-fax"></i> Cetak
                                                Nota</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-dark"
                                        id="table_detail_barang">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_detail_barang_tbody">
                                            <tr>
                                                <td colspan="6"
                                                    class="text-center"> -- Tidak ada data -- </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade"
            id="modal-edit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modalTitleId">Edit Barang</h5>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark"
                                        disabled />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input class="form-control text-dark"
                                        type="number"
                                        placeholder="1" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"><i class="mdi mdi-window-close"></i> Tutup</button>
                        <button type="submit"
                            class="btn btn-success"><i class="mdi mdi-floppy"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade"
            id="modal-hapus"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modalTitleId">Hapus Barang</h5>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="display4">
                                <h4>Apakah Barang Ingin dihapus?</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"><i class="mdi mdi-window-close"></i> Batal</button>
                        <button type="submit"
                            class="btn btn-success"><i class="mdi mdi-check"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('jssj')
        <script>
            var modalEd = document.getElementById('modal-edit');

            modalEd.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                let button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                let recipient = button.getAttribute('data-bs-whatever');

                // Use above variables to manipulate the DOM
            });
        </script>
        <script>
            var modalHp = document.getElementById('modal-hapus');

            modalHp.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                let button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                let recipient = button.getAttribute('data-bs-whatever');

                // Use above variables to manipulate the DOM
            });
        </script>
        <script>
            $(document).ready(function() {
                let baseUrl = $(location).attr('protocol') + '//' + $(location).attr('host') + '/';

                let html = '';
                let grandTotal = 0;
                let diskon = 0;

                $.get(baseUrl + "purchase/get_detail",
                    function(response) {
                        if (response.result != null || response.result != [] || response
                            .result != '') {
                            $('#table_detail_barang_tbody').empty();
                            let subTotal = 0;
                            $.each(response.result, function(key, value) {
                                html += '<tr>';
                                html += '<td>' + (key + 1) + '</td>';
                                html += '<td>' + value.name_barang + '</td>';
                                html += '<td>' + value.harga_beli + '</td>';
                                html += '<td>' + value.qty + '</td>';
                                html += '<td>' + (value.harga_beli * value.qty) +
                                    '</td>';
                                html += '<td>' +
                                    "<button type='submit' class = 'btn btn-icon btn-success btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'submit' class = 'btn btn-icon btn-danger btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
                                    '</td>'
                                html += '</tr>';
                                subTotal += (value.harga_beli * value.qty);
                            });
                            $('#table_detail_barang').append(html);
                            html = '';
                            grandTotal = subTotal;
                            $("#grand_total").val(grandTotal);
                        }
                    },
                );

                $("#keyBarang").on('change', function() {
                    if (this.value) {
                        $.get(baseUrl + 'cari_barang/' + this.value, function(response) {
                            if (response) {
                                $('#barangs_id').val(response.result[0]['id']);
                                $('#no_barang').text(response.result[0]['no_barang']);
                                $('#name_barang').text(response.result[0]['name_barang']);
                                $('#harga_beli').text(response.result[0]['harga_beli']);
                                $('#qty').val('');
                            } else {
                                $('#no_barang').text('-');
                                $('#name_barang').text('-');
                                $('#harga_beli').text('-');
                                $('#qty').val('');
                            }
                        });
                    } else {
                        $('#no_barang').text('-');
                        $('#name_barang').text('-');
                        $('#harga_beli').text('-');
                        $('#qty').val('');
                    }
                });

                $("#form-barang").submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();

                    let barangs_id = $("#barangs_id").val();

                    $.get(baseUrl + "purchase/validate_barang/" + barangs_id,
                        function(response) {
                            if (response) {
                                if (response[0]['jml_barang'] > 1) {
                                    console.log(
                                        `id barang nya : ${response[0]['barangs_id']}\njumlah nya ada : ${response[0]['jml_barang']}`
                                    );

                                    $.ajax({
                                        type: "PUT",
                                        url: baseUrl + "purchase/update_detail/" + barangs_id,
                                        data: formData,
                                        dataType: 'JSON',
                                        success: function(response) {
                                            console.log('oke data keubah');
                                            console.log(response);
                                        },
                                        error: function(error) {
                                            console.error('data gak keubah bro');
                                            console.log(error);
                                        },
                                        complete: function(response) {
                                            console.log('penting mari');
                                            console.log(response);
                                        }
                                    });
                                }
                            }
                        }
                    );

                    $.post(baseUrl + "purchase/save_detail", formData,
                        function(response) {
                            $.get(baseUrl + "purchase/get_detail",
                                function(response) {
                                    if (response.result != null || response
                                        .result != [] || response
                                        .result != '') {
                                        $('#table_detail_barang_tbody').empty();
                                        let subTotal = 0;
                                        $.each(response.result, function(key,
                                            value) {
                                            html += '<tr>';
                                            html += '<td>' + (key + 1) +
                                                '</td>';
                                            html += '<td>' + value
                                                .name_barang + '</td>';
                                            html += '<td>' + value
                                                .harga_beli + '</td>';
                                            html += '<td>' + value.qty +
                                                '</td>';
                                            html += '<td>' + (value
                                                    .harga_beli * value.qty
                                                ) +
                                                '</td>';
                                            html += '<td>' +
                                                "<button type='submit' class = 'btn btn-icon btn-success btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'submit' class = 'btn btn-icon btn-danger btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
                                                '</td>'
                                            html += '</tr>';
                                            subTotal += (value.harga_beli *
                                                value.qty);
                                        });
                                        $('#table_detail_barang').append(html);
                                        html = '';
                                        grandTotal = subTotal;

                                        if (grandTotal >= 200000 && grandTotal <
                                            350000) {
                                            diskon = (grandTotal * 5) / 100;
                                            grandTotal = grandTotal - diskon;
                                            $("#persen_diskon").text("5%");
                                        } else if (grandTotal >= 350000) {
                                            diskon = (grandTotal * 7) / 100;
                                            grandTotal = grandTotal - diskon;
                                            $("#persen_diskon").text("7%");
                                        } else {
                                            diskon = 0;
                                            grandTotal = grandTotal - diskon;
                                        }
                                    }
                                    $('#no_barang').text('-');
                                    $('#name_barang').text('-');
                                    $('#harga_beli').text('-');
                                    $('#qty').val('');
                                    $("#keyBarang").val("").change();

                                    $("#diskon").val(diskon);
                                    $("#grand_total").val(grandTotal);
                                },
                            );
                        }
                    );
                });

                $("#bayar").keyup(function(e) {
                    $("#kembali").val($(this).val() - $("#grand_total").val());
                });
            });
        </script>
    @endpush
</x-layout.app>
