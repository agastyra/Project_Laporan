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
                <thead>

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
                </thead>
                <tbody>
                    @foreach ($detail as $item)

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">{{ $item->barang->name_barang }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $item->qty }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $item->subTotal }}</p>
                        </td>
                    </tr>

                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                        <td class="payment">
                            <h2>Rp37.500,-</h2>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
        <!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong> <em>*Barang yang sudah dibeli tidak
                    dapat
                    dikembalikan. Jangan lupa berkunjung kembali </em>
            </p>
        </div>

    </div>
    <!--End InvoiceBot-->
</div>
<!--End
 Invoice-->