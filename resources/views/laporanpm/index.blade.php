<x-layout.app>
    <style>
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


        p {
            margin-left: 100px;
        }

        h5 {
            margin-left: 20px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h3 class="card-title col-md-8"><i class="mdi mdi-table text-danger"></i> Laporan Perubahan Modal
                        </h3>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="">Sortir Bulan: </label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="date" id="" name="" class="form-control text-light">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('print.ns') }}" method="get" target="_blank">
                                @csrf
                                <button type="submit" class="btn btn-info"><i class="mdi mdi-printer"></i>
                                    Print</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        {{-- <h5>Penjualan</h5>
                        <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span
                                class="price-value">$4000</span>
                        </p> --}}
                        <h5>Modal awal</h5>
                        <h5>Laba bersih setelah pajak:</h5>
                        <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span
                                class="price-value">$4000</span>
                        </p>
                        {{-- <h5><span class="price-label">Harga Pokok Penjualan</span> <span class="dotted-seemless"></span>
                            <span class="price-value">$4000</span>
                        </h5>
                        <h5>Beban Operasional:</h5>
                        <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span
                                class="price-value">$4000</span>
                        </p>
                        <h5><span class="price-label">Total Beban Operasional</span> <span
                                class="dotted-seemless"></span>
                            <span class="price-value">$4000</span>
                        </h5> --}}
                        <h5>prive</h5>
                        <h5>Modal akhir:</h5>
                        <p><span class="price-label">Price</span> <span class="dotted-line"></span> <span
                                class="price-value">$4000</span>
                        </p>
                        {{-- <h5><span class="price-label">Laba Bersih</span> <span class="dotted-seemless"></span> <span
                                class="price-value">$4000</span>
                        </h5> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
