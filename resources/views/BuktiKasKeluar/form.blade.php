<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Cash Out Receipt</div>
                <hr>
                <form action="{{ route('save_cash_out') }}"
                    method="POST">
                    <div class="form-check mb-4">
                        <label class="form-check-label"
                            for="other_cash_out">
                            <input type="checkbox"
                                class="form-check-input"
                                id="other_cash_out"
                                name="is_other"
                                value="1"
                                @if (old('is_other')) checked
                                @else @endif>
                            Pengeluaran lainnya
                        </label>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tanggal_cash_out">Tanggal</label>
                        <input type="date"
                            class="form-control form-control-rounded text-light"
                            value="{{ date('Y-m-d') }}"
                            name='tanggal'
                            id="tanggal_cash_out">
                    </div>
                    <div class="form-group mb-4">
                        <label for="purchase_cash_out"
                            class="form-label">Transaksi Pembelian</label>
                        <select class="js-example-basic-single text-light"
                            style="width:100%"
                            name="transaksi_pembelian_id"
                            id="purchase_cash_out">
                            @forelse ($transaksis as $transaksi)
                                <option value="{{ $transaksi->id }}">
                                    {{ "( $transaksi->date ) $transaksi->no_transaction" }}
                                </option>
                            @empty
                                <option value="">-- Tidak ada data --</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="akun_cash_out"
                            class="form-label">Akun</label>
                        <select class="js-example-basic-single text-light"
                            style="width:100%"
                            name="akun_id"
                            id="akun_cash_out">
                            @forelse ($akuns as $akun)
                                <option value="{{ $akun->id }}">{{ "( $akun->no_account ) $akun->name_account" }}
                                </option>
                            @empty
                                <option value="">-- Tidak ada data --</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlah">Jumlah</label>
                        <input type="number"
                            class="form-control form-control-rounded text-light"
                            id="jumlah"
                            name="balance"
                            placeholder="Please fill this input..."
                            value="0">
                    </div>
                    <div class="form-group mb-4">
                        <label for="description_cash_out"
                            class="form-label">Deskripsi</label>
                        <textarea class="form-control text-light"
                            style="height: 6em"
                            id="description_cash_out"
                            name="description"
                            placeholder="Please enter description..."
                            rows="3"></textarea>
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button"
                                href="{{ route('cash_out') }}">Batal</a>
                        </div>
                </form>
                </d iv>
            </div>
        </div>

</x-layout.app>
