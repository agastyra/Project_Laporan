<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8"><i class="mdi mdi-cash text-danger icon-md"></i> Neraca Saldo</h4>
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
                            <button type="submit" class="btn btn-info"><i class="mdi mdi-printer"></i> Print</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1001</td>
                                    <td>Opening Balance</td>
                                    <td></td>
                                    <td class="credit">1000.00</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Ending Balance</td>
                                    <td class="debit balance">900.00</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>