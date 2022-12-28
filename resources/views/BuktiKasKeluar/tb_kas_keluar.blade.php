<x-layout.app>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">jurnal bukti kas keluar <?= Date('M Y'); ?></h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">tgl</th>
                                <th scope="col">no trans pemb</th>
                                <th scope="col">is other</th>
                                <th scope="col">other account</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><?= date("d M Y") ?></td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->
</x-layout.app>
