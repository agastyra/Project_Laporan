<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Akun Baru</div>
           <hr>
            <form>

                <div class="form-group">
            <label for="input-6"> <input type="checkbox">Header Akun</label><br>
            <br>
            <label for="input-6">Header Nomor</label>
            <input type="search" class="form-control form-control-rounded col-lg-6" placeholder="Ketik Untuk Mencari"><br>
                </div>

                <div class="form-group">
            <label for="input-6">Nomor Akun</label>
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Masukan No Akun">
            <p style="color: red"><em>*ketik nomor akun berdasarkan header</em></p>
           </div>
<br>
           <div class="form-group">
            <label for="input-6">Nama Akun</label>
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Masukan Nama Akun">
           </div>

           <div class="form-group">
            <label for="input-7">Tipe Akun</label><br>
           <select name="tipe_akun" id="tipe" style="width: 50%">
            <option value="tampilan">--Pilih Tipe Akun--</option>
            <option value="akun1">akun1</option>
            <option value="akun2">akun2</option>
           </select>
           </div>

           <div class="form-group py-2">
             <div align="right">
                    <button class="positive ui button">Simpan</button>
                    <button class="negative ui button">Batal</button>
                    </div>
          </form>
         </div>
         </div>
      </div>
    </div>

</x-layout.app>
