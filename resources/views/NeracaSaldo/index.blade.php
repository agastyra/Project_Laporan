<x-layout.app>
    <h1>Neraca Saldo</h1>

    <div class="col-md-12 mt-4">
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th style="background-color:blue" scope="col-md">Kode Akun</th>
                        <th style="background-color:blue" scope="col-md">Nama Akun</th>
                        <th style="background-color:blue" scope="col-md">Debit</th>
                        <th style="background-color:blue" scope="col-md">Kredit</th>
                        <th style="background-color:blue" scope="col-md">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($akun as $a) --}}
                    <tr>
                        <td>001</td>
                        <td>aktiva</td>
                        <td>5000</td>
                        <td>0</td>
                        <td>5000</td>
                        {{-- <td>{{ $a->kode_akun }}</td>
                <td>{{ $a->nama_akun }}</td>
                <td>{{ $a->jenis_akun == 'debit' ? $a->saldo : '' }}</td>
                <td>{{ $a->jenis_akun == 'kredit' ? $a->saldo : '' }}</td>
                <td>{{ $a->saldo }}</td> --}}
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="background-color:blue" scope="col-md"><strong>Total</strong></th>
                        <th colspan="2" style="background-color:blue" scope="col-md"><strong></strong></th>
                        <th colspan="2"style="background-color:blue" scope="col-md"><strong></strong></th>


                        {{-- <td>{{ $saldoDebit }}</td>
                <td>{{ $saldoKredit }}</td>
                <td>{{ $saldoAkhir }}</td> --}}
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layout.app>
