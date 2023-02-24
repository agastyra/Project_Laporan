<x-layout.app>
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col" style="margin-top: 10%" align="left">
                <p>Thrift Shop Bismillah</p>
                <p>Jl.Jakarta No.58</p>
                <p>Malang</p>
            </div>
            <div class="col">
                <Strong>THRIFT SHOP BISMILLAH</Strong><br>
                <strong><em>Bukti Kas Masuk</em></strong>
            </div>
            <div class="col">
                <p>No Bukti : (.. . . . . . . . . .)</p>
                <p>Tanggal : <?= Date(' d M Y') ?></p>

            </div>
        </div>
    </div>

    <hr>
    <br><br>
    <section class="col" style="margin-left: 10%">
        <p>Diterima Dari :
            <hr style="border-top: 2px dotted black">
        </p>
        <p>Senilai :
            <hr style="border-top: 2px dotted black">
        </p>
        <p>Keterangan :
            <hr style="border-top: 2px dotted black">
        </p>
    </section><br>
    <hr>

    <section class="container row align-items-start">
        <div class="container-fluid col-lg-9" align="right" style="margin-top:5%">
            <p>Malang, <?= Date('d M Y') ?></p>
            <br><br>
            <p style="margin-right: 2%;">Yang Menerima </p>


        </div>

    </section>
</x-layout.app>
