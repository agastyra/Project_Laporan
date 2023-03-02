<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Buku Besar
                    </h4>
                    <div class="form-group row mt-5">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-calendar text-info"></i>
                            Bulan</label>
                        <div class="col-sm-9">
                            <input class="form-control text-light"
                                type="month"
                                wire:model='month'
                                value="{{ $month }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                            Akun</label>
                        <div class="col-sm-9">
                            <select class="form-control form-select text-light"
                                wire:model='selectedAccount'
                                name='selectedAccount'
                                id="my-select"
                                style="width:100%">
                                <option value="">-- Pilih akun --</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">( {{ $account->no_account }} )
                                        {{ $account->name_account }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($bukti_kas_keluars as $bkk)
                                        <tr>
                                            <td>{{ $bkk->tanggal }}</td>
                                            <td>{{ $bkk->description }}</td>
                                            <td>{{ $bkk->akun_amount }}</td>
                                            <td>0</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
