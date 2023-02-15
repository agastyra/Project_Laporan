<div class="container text-center">
    <div class="row align-items-start">
        <div class="col"
            style="margin-top: 10%"
            align="left">
            <p>Thrift Shop Bismillah</p>
            <p>Jl.Jakarta No.58</p>
            <p>Malang</p>
        </div>
        <div class="col">
            <Strong>THRIFT SHOP BISMILLAH</Strong>
        </div>
        <div class="col">
            <p>No Bukti : ( {{ $bkk->no_transaction }} )</p>
            <p>Tanggal : {{ $bkk->tanggal }}</p>

        </div>
    </div>
</div>

<hr>
<br><br>
<section class="col"
    style="margin-left: 10%">
    <p>Dibayarkan Kepada : @if ($bkk->is_other)
            --
        @else
            @if ($bkk->transaksi_pembelian->vendor == 1)
                Risky
            @elseif ($bkk->transaksi_pembelian->vendor == 2)
                Muhlas
            @elseif ($bkk->transaksi_pembelian->vendor == 3)
                Mukhlis
            @endif
        @endif
        <hr style="border-top: 2px dotted black">
    </p>
    <p>Terbilang :
        <hr style="border-top: 2px dotted black">
    </p>
    <p>Untuk Keperluan : {{ $bkk->description }}
        <hr style="border-top: 2px dotted black">
    </p>
</section>
<hr>

<section class="row align-items-start">
    <div class="col"
        align="left"
        style="margin-top:5%">
        <p>Jumlah : @if ($bkk->is_other)
                Rp. {{ number_format($bkk->akun_amount, 0, ',', '.') }}
            @else
                Rp. {{ number_format($bkk->transaksi_pembelian->grand_total, 0, ',', '.') }}
            @endif
            <hr style="border-top: 2px dotted black">
        </p>
    </div>
    <div class="col"
        align="center"
        style="margin-top:5%">
        <p>Malang, <?= Date('d M Y') ?></p>
        <p>Yang Mengeluarkan </p>
        <br><br>
        <hr style="border-top: 2px dotted black">
    </div>

</section>
