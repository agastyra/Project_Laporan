<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Cash Out Receipt <span>( {{ $transactionNumber }} )</span></div>
                <hr>
                <form action="{{ route('save_cash_out') }}"
                    method="POST">
                    @csrf
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
                            class="form-control form-control-rounded text-light @error('tanggal')
                                is-invalid
                            @enderror"
                            value="{{ old('tanggal', date('Y-m-d')) }}"
                            name='tanggal'
                            id="tanggal_cash_out">
                        @error('tanggal')
                            <div id="other_validation_tanggal"
                                class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-4"
                        id="purchase">
                        <label for="purchase_cash_out"
                            class="form-label">Transaksi Pembelian</label>
                        <select
                            class="js-example-basic-single text-light @error('transaksi_pembelian_id')
                            is-invalid
                        @enderror"
                            style="width:100%"
                            name="transaksi_pembelian_id"
                            id="purchase_cash_out">
                            <option value=""> -- </option>
                            @forelse ($transaksis as $transaksi)
                                <option value="{{ $transaksi->id }}">
                                    {{ "( $transaksi->date ) $transaksi->no_transaction" }}
                                </option>
                            @empty
                                <option value="">-- Tidak ada data --</option>
                            @endforelse
                        </select>
                        @error('transaksi_pembelian_id')
                            <div id="other_validation_purchase"
                                class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-4"
                        id="akun_other">
                        <label for="akun_cash_out"
                            class="form-label">Akun</label>
                        <select
                            class="js-example-basic-single text-light @error('akun_id')
                            is-invalid
                        @enderror"
                            style="width:100%"
                            name="akun_id"
                            id="akun_cash_out">
                            <option value=""> -- </option>
                            @forelse ($akuns as $akun)
                                <option value="{{ $akun->id }}">{{ "( $akun->no_account ) $akun->name_account" }}
                                </option>
                            @empty
                                <option value="">-- Tidak ada data --</option>
                            @endforelse
                        </select>
                        @error('akun_id')
                            <div id="other_validation_purchase"
                                class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-4"
                        id="amount_other">
                        <label for="jumlah">Jumlah</label>
                        <input type="number"
                            class="form-control form-control-rounded text-light @error('akun_amount')
                            is-invalid
                        @enderror"
                            id="jumlah"
                            name="akun_amount"
                            placeholder="Please fill this input..."
                            value="{{ old('akun_amount', 0) }}">
                        @error('akun_amount')
                            <div id="other_validation_purchase"
                                class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="purchase_bkk">
                        <div class="form-group mb-4"
                            id="purchase_vendor">
                            <label for="purhcase_supplier">Vendor</label>
                            <p id="purhcase_supplier"
                                class="fs-5">--</p>
                        </div>
                        <div class="form-group mb-4"
                            id="purchase_amount">
                            <label for="purhcase_jumlah">Jumlah</label>
                            <p id="purhcase_jumlah"
                                class="fs-5">0</p>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="description_cash_out"
                            class="form-label">Deskripsi</label>
                        <textarea
                            class="form-control text-light @error('description')
                            is-invalid
                        @enderror"
                            style="height: 6em"
                            id="description_cash_out"
                            name="description"
                            placeholder="Please enter description..."
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div id="other_validation_purchase"
                                class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button"
                                href="{{ route('cash_out') }}">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>

    @push('jssj')
        <script src="{{ asset('assets/js/bukti_kas_keluar/index.js') }}"></script>
    @endpush
</x-layout.app>
