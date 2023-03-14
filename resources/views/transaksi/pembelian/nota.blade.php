<div id="invoice-POS">

    <style>
        table tr .th,
        table tr td {
            padding: 13px
        }

        .mt-3 {
            margin-top: 3em;
        }

        .text-start {
            text-align: left
        }

        .text-end {
            text-align: right
        }
    </style>

    <div id="mid">
        <div class="info">
            <div style="align-items: center;">
                <h3>Thirft Shop Bismillah</h3>
            </div>
            <p align-content-center>
                Alamat : Jalan Jakarta No:38 Malang</br>
                Email : bismillahthrift@shop.com</br>
                Telephone : 087894531278</br>
            </p>
        </div>
    </div>
    <!--End Invoice Mid-->

    <div id="ket">
        <span>Nota pembelian:( {{ $transaksi->no_transaction }} )</span> <br> <br>
    </div>
    <div id="bot">

        <div id="table">
            <table>
                <tr>
                    <th class="item text-start th">
                        Item
                    </th>
                    <th class="Hours text-end th">
                        Harga
                    </th>
                    <th class="Hours text-end th">
                        Qty
                    </th>
                    <th class="Rate text-end th">
                        Sub Total
                    </th>
                </tr>

                @forelse ($transaksi->detail_pembelian as $detail)
                    <tr class="service">
                        <td class="tableitem text-start td">
                            {{ $detail->barang->name_barang }}
                        </td>
                        <td class="tableitem text-end td">
                            Rp. {{ number_format($detail->barang->harga_beli, 0, ',', '.') }},-
                        </td>
                        <td class="tableitem text-end td">
                            {{ $detail->qty }}
                        </td>
                        <td class="tableitem text-end td">Rp.
                            {{ number_format($detail->qty * $detail->barang->harga_beli, 0, ',', '.') }},-
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada item.</td>
                    </tr>
                @endforelse

                {{-- space --}}
                <tr>
                    <h3></h3>
                </tr>

                <tr class="tabletitle mt-3">
                    <th class="Rate text-start">
                        Total
                    </th>
                    <th class="payment text-end"
                        colspan="2">
                        Rp. {{ number_format($transaksi->diskon + $transaksi->grand_total, 0, ',', '.') }},-
                    </th>
                </tr>

                <tr class="tabletitle mt-3">
                    <th class="Rate text-start">
                        Diskon
                    </th>
                    <th class="payment text-end"
                        colspan="2">
                        Rp. {{ number_format($transaksi->diskon, 0, ',', '.') }},-
                    </th>
                </tr>

                <tr class="tabletitle">
                    <th class="Rate text-start">
                        Total bayar
                        </td>
                    <th class="payment text-end"
                        colspan="2">
                        Rp. {{ number_format($transaksi->grand_total, 0, ',', '.') }},-
                    </th>
                </tr>

                <tr class="tabletitle">
                    <th class="Rate text-start">
                        Bayar
                        </td>
                    <th class="payment text-end"
                        colspan="2">
                        Rp. {{ number_format($transaksi->bayar, 0, ',', '.') }},-
                    </th>
                </tr>

                <tr class="tabletitle">
                    <th class="Rate text-start">
                        Kembali
                        </td>
                    <th class="payment text-end"
                        colspan="2">
                        Rp. {{ number_format($transaksi->kembali, 0, ',', '.') }},-
                    </th>
                </tr>

            </table>
        </div>
        <!--End Table-->
    </div>

    <div id="legalcopy">
        <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong> <em>*Barang yang sudah dibeli tidak
                dapat
                dikembalikan. Jangan lupa berkunjung kembali </em>
        </p>
    </div>
    <!--End InvoiceBot-->

</div>
<!--End Invoice-->
