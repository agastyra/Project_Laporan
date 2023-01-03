<x-layout.app>
    <style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 44mm;
        background: #FFF;
    }

    .tabletitle {
        color: black;
    }

    #invoice-POS ::selection {
        background: #f31544;
        color: #FFF;
    }

    #invoice-POS ::moz-selection {
        background: #f31544;
        color: #FFF;
    }

    #invoice-POS h1 {
        font-size: 1.5em;
        color: #222;
    }

    #invoice-POS h2 {
        font-size: .9em;
    }

    #invoice-POS h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    #invoice-POS p {
        font-size: .7em;
        color: #666;
        line-height: 1.2em;
    }

    #invoice-POS #top,
    #invoice-POS #mid,
    #invoice-POS #bot {

        border-bottom: 1px solid #EEE;
    }

    #invoice-POS #mid {
        min-height: 80px;
    }

    #invoice-POS #bot {
        min-height: 50px;
    }

    #invoice-POS .info {
        display: block;
        margin-left: 0;
    }

    #invoice-POS .title {
        float: right;
    }

    #invoice-POS .title p {
        text-align: right;
    }

    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoice-POS .tabletitle {
        font-size: .5em;
        background: #EEE;
    }

    #invoice-POS .service {
        border-bottom: 1px solid #EEE;
    }

    #invoice-POS .item {
        width: 24mm;
    }

    #invoice-POS .itemtext {
        font-size: .5em;
    }

    #invoice-POS #legalcopy {
        margin-top: 5mm;
    }
    </style>


    </head>

    <body translate="no">


        <div id="invoice-POS">

            <div id="mid">
                <div class="info">
                    <h2>Info Kontak</h2>
                    <p align-content-center>
                        Alamat : Jalan Jakarta No:38 Malang</br>
                        Email : bismillahthrift@shop.com</br>
                        Telephone : 087894531278</br>
                    </p>
                </div>
            </div>
            <!--End Invoice Mid-->

            <div id="bot">

                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>

                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">Roti Panggang</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">5</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">Rp5.000,-</p>
                            </td>
                        </tr>

                        <tr class="tabletitle">
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>Rp37.500,-</h2>
                            </td>
                        </tr>

                    </table>
                </div>
                <!--End Table-->

                <div id="legalcopy">
                    <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong> <em>*Barang yang sudah dibeli
                            tidak
                            dapat
                            dikembalikan. Jangan lupa berkunjung kembali </em>
                    </p>
                </div>

            </div>
            <!--End InvoiceBot-->
        </div>
        <!--End
 Invoice-->

</x-layout.app>
