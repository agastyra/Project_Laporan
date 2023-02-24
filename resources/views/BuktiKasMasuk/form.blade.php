<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Form Bukti Kas Masuk</div>
                <hr>
                <form>
                    <div class="form-group">
                        <label for="input-6">ID</label>
                        <input type="text" class="form-control form-control-rounded" id="input-6"
                            placeholder="--Diisi Secara Otomatis--" disabled>
                    </div>
                    <div class="form-group">
                        <label for="input-7">Tanggal</label>
                        <input type="date" class="form-control form-control-rounded" id="input-7">
                    </div>

                    <div class="form-group">
                        <label for="input-7">No Bukti Penjualan</label>
                        <input type="text" class="form-control form-control-rounded" id="input-7"
                            placeholder="Masukan no yang tertera di nota">
                    </div>

                    <div class="form-group">
                        <label for="input-8">Keterangan</label>
                        <input type="text" class="form-control form-control-rounded" id="input-8"
                            placeholder="Masukan Keterangan">
                    </div>
                    <div class="form-group">
                        <label for="input-9">Is Other</label>
                        <input type="text" class="form-control form-control-rounded" id="input-9"
                            placeholder="Enter Is Other">
                    </div>
                    <div class="form-group">
                        <label for="input-10">Other Account</label>
                        <input type="text" class="form-control form-control-rounded" id="input-10"
                            placeholder="Enter Other Account">
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button" href="{{ route('accounts') }}">Batal</a>



                        </div>




                </form>
            </div>
        </div>
    </div>
</x-layout.app>