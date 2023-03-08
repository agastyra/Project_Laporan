<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .header {
            text-align: center;
        }

        .separator {
            border: 1px solid black;
            margin: 20px 0;
        }

        .dotted-line {
            border-top: 1px dotted black;
            margin: 0 10px;
            display: inline-block;
            width: 70%;
            height: 1px;
            vertical-align: middle;
        }

        .dotted-seemless {
            border-top: 1px dotted black;
            margin: 0 10px;
            display: inline-block;
            width: 75%;
            height: 1px;
            vertical-align: middle;
            visibility: hidden;
        }

        .price-label,
        .price-value {
            display: inline-block;
            justify-content: space-between;
            vertical-align: middle;
        }

        .price-label {
            display: inline-block;
            vertical-align: middle;
            font-weight: bold;
            margin-right: 10px;
        }
        

        p{
            margin-left: 100px;
        }

        h3{
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <header>
        <h1 class="header">Laporan Laba Rugi</h1>
        <h1 class="header">Toko Thrift Bismillah</h1>
        <h1 class="header">Bulan Sekian</h1>
    </header>
    <hr class="separator">
    <h3>Penjualan</h3>
    <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span class="price-value">$4000</span>
    </p>
    <h3>Penjualan Bersih</h3>
    <h3>Harga Pokok Penjualan:</h3>
    <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span class="price-value">$4000</span>
    </p>
    <h3><span class="price-label">Harga Pokok Penjualan</span> <span class="dotted-seemless"></span> <span class="price-value">$4000</span>
    </h3>
    <h3>Beban Operasional:</h3>
    <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span class="price-value">$4000</span>
    </p>
    <h3><span class="price-label">Total Beban Operasional</span> <span class="dotted-seemless"></span> <span class="price-value">$4000</span>
    </h3>
    <h3>Laba Bersih</h3>
    <h3>Biaya Lain-lain:</h3>
    <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span class="price-value">$4000</span>
    </p>
    <h3><span class="price-label">Laba Bersih</span> <span class="dotted-seemless"></span> <span class="price-value">$4000</span>
    </h3>
</body>

</html>