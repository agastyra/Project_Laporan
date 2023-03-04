<x-layout.app>
    @foreach ($jurnal_memorials as $jurnal_memorial)
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal Umum (
                            {{ $jurnal_memorial->no_transaction }} )
                        </h4>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                                Tanggal</label>
                            <div class="col-sm">
                                <input class="form-control text-dark disabled"
                                    type="date"
                                    name="date"
                                    readonly
                                    disabled
                                    value="{{ $jurnal_memorial->date }}" />
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="table-responsive">
                                <table class="table table-dark"
                                    id="table_detail_akun">
                                    <thead>
                                        <tr>
                                            <th>Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_detail_akun_body">
                                        @foreach ($jurnal_memorial->jurnal_memorial_detail as $detail)
                                            <tr>
                                                <td>( {{ $detail->akun->no_account }} )
                                                    {{ $detail->akun->name_account }}</td>
                                                <td>{{ number_format($detail->debet, 0, ',', '.') }}</td>
                                                <td>{{ number_format($detail->kredit, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-layout.app>
