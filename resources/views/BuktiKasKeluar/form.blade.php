<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Kas Keluar</div>
                <hr>
                <form>
                    <div class="form-group">
                        <label for="input-6">ID</label>
                        <input type="text" class="form-control form-control-rounded" id="input-6"
                            placeholder="--Terisi otomatis--" disabled>
                    </div>
                    <div class="form-group">
                        <label for="input-7">Tanggal</label>
                        <input type="Date" class="form-control form-control-rounded" id="input-7">
                    </div>
                    <div class="form-group">
                        <label for="input-8">No Transaksi Pembelian</label>
                        <input type="text" class="form-control form-control-rounded" id="input-8"
                            placeholder="Masukan No Transaksi">
                    </div>
                    <div class="form-group">
                        <label for="input-9">is other</label>
                        <input type="text" class="form-control form-control-rounded" id="input-9"
                            placeholder="Enter is other">
                    </div>
                    <div class="form-group">
                        <label for="input-10">other account</label>
                        <input type="text" class="form-control form-control-rounded" id="input-10"
                            placeholder="Enter another account">
                    </div>
                    <div class="form-group py-2">
                        <div align="right">
                            <button class="positive ui button">Simpan</button>
                            <a class="negative ui button" href="{{ route('accounts') }}">Batal</a>
                        </div>
                </form>
            </d
iv>
        </div>
    </div>

</x-layout.app>