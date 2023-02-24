<x-layout.app>
    @foreach ($transaksis as $transaksi)
        <h3 class="header mb-3">Transaksi Pembelian ({{ $transaksi->no_transaction }})</h3>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9 text-dark">
                                        <input class="form-control text-dark disabled"
                                            value="{{ $transaksi->date }}"
                                            id="date_transaksi"
                                            name="date"
                                            type="date"
                                            readonly
                                            disabled />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Vendor</label>
                                    <div class="col-sm-9">
                                        <select name="vendor"
                                            id="vendor"
                                            disabled
                                            class="form-control form-select text-dark">
                                            @for ($i = 1; $i <= 3; $i++)
                                                @if (old('vendor', $transaksi->vendor) == $i)
                                                    <option value="{{ $transaksi->vendor }}"
                                                        selected>
                                                        @if ($transaksi->vendor == 1)
                                                            Risky
                                                        @elseif ($transaksi->vendor == 2)
                                                            Mukhlas
                                                        @elseif ($transaksi->vendor == 3)
                                                            Mukhlis
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="{{ $i }}">
                                                        @if ($i == 1)
                                                            Risky
                                                        @elseif ($i == 2)
                                                            Mukhlas
                                                        @elseif ($i == 3)
                                                            Mukhlis
                                                        @endif
                                                    </option>
                                                @endif
                                            @endfor
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
                                            value="{{ $transaksi->diskon }}"
                                            readonly
                                            disabled />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grand Total</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            id="grand_total"
                                            name="grand_total"
                                            placeholder="Total..."
                                            value="{{ $transaksi->grand_total }}"
                                            readonly
                                            disabled />
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Bayar</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            type="number"
                                            id="bayar"
                                            name="bayar"
                                            placeholder="0"
                                            readonly
                                            disabled
                                            value="{{ $transaksi->bayar }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kembali</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark disabled"
                                            value="{{ $transaksi->kembali }}"
                                            id="kembali"
                                            name="kembali"
                                            readonly
                                            disabled />
                                        <div class="col-sm-12 mt-3">
                                            <button type="button"
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
                                            </tr>
                                        </thead>
                                        <tbody id="table_detail_barang_tbody">
                                            @forelse ($transaksi->detail_pembelian as $detail)
                                                <tr id="barang_{{ $detail->barang_id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->barang->name_barang }}</td>
                                                    <td>{{ $detail->barang->harga_beli }}</td>
                                                    <td class="barang_qty">{{ $detail->qty }}</td>
                                                    <td class="barang_subtotal">
                                                        {{ $detail->barang->harga_beli * $detail->qty }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6"
                                                        class="text-center"> -- Tidak ada data -- </td>
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
            <!-- Modal detail -->
            <div class="modal fade"
                id="modal-detail"
                tabindex="-1"
                role="dialog"
                aria-labelledby="detail_barang"
                aria-hidden="true">
                <div class="modal-dialog"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="detail_barang">Detail Barang</h5>
                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden"
                                    name="transaksi_pembelian_id"
                                    id="detail_transaksi_id">
                                <input type="hidden"
                                    name="barang_id"
                                    id="detail_barang_id">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-dark"
                                            id="detail_nama"
                                            name="name_barang"
                                            readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-white"
                                            type="number"
                                            placeholder="0"
                                            id="detail_qty"
                                            name="qty" />
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
        </div>
    @endforeach
</x-layout.app>
