<x-layout.app>

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Form Tambah Barang</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-white">
                <div class="card-body" style="background: black; color: white;">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-white"></i>
                            </div>
                            <h5 class="mb-0 text-white">Silahkan isi form berikut</h5>
                        </div>
                        <hr />

                        <form action="{{route('simpan_barang')}}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Id Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_barang" value="{{old('no_barang')}}"
                                        class="form-control" id="inputEnterYourName" placeholder="Masukan Kode Barang"
                                        style="color: white;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_barang" value="{{old('name_barang')}}"
                                        class="form-control" id="inputPhoneNo2" placeholder="Masukan Nama barang"
                                        style="color: white;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="number" name="stok" value="{{old('stok')}}" class="form-control"
                                        id="inputEmailAddress2" placeholder="Masukan Jumlah Barang"
                                        style="color: white;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Harga Beli</label>
                                <div class="col-sm-9">
                                    <input type="number" name="harga_beli" value="{{old('harga_beli')}}"
                                        class="form-control" id="inputChoosePassword2" placeholder="Masukan Harga Beli"
                                        style="color: white;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Harga Jual</label>
                                <div class="col-sm-9">
                                    <input type="number" name="harga_jual" value="{{old('harga_jual')}}"
                                        class="form-control" id="inputConfirmPassword2" placeholder="Masukan Harga Jual"
                                        style="color: white;">
                                </div>
                            </div>

                            <div align="right">
                                <button class="positive ui button">Simpan</button>
                                <a class="negative ui button" href="{{ route('barang') }}">Batal</a>
                            </div>

                        </form>




















                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>