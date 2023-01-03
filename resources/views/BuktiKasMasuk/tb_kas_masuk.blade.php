<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">jurnal bukti kas keluar <?= Date('M Y'); ?></h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">tgl</th>
                                <th scope="col">No Bukti Pembelian</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><?= date("d M Y") ?></td>
                                <td>Otto</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
