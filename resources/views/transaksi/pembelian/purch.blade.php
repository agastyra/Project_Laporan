<x-layout.app>
    <div class="row">
        <h3 class="header">Transaksi Pembelian</h3>
        <div class="col-lg-4 grid-margin"></div>
        <li class="active">Transaksi Pembelian</li>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addform()" class="btn btn-success btn-xs btn-flat"><i
                            class="fa-plus-circle ml-2"></i>Transaksi Baru</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>diskon</th>
                            <th>Grand Total</th>
                            <th width="15%">Aksi<i class="fa fa-cog"></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
