        <div id="invoice-POS">

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
            <div id="penjualan">
                <span>Nota Penjualan</span>
            </div>

            <div style="align-items: right;">
                <span>No : {{$sales->no_transaction}} </span>
            </div>
            <div id="bot">

                <div id="table">
                    <table class="table table-dark" id="table_penjualan">
                        <thead>



                            <tr>
                                <th>item</th>
                                <th>Qty</th>
                                <th>Sub total</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>

                            <tr>
                                <td>total</td>
                                <td>1</td>
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
