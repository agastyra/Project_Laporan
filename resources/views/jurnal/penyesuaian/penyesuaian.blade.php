<x-layout.app>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-tittle"><i class="mdi mdi-table-edit text-danger icon-md"></i> Jurnal
                        Penyesuaian
                    </h4>
                    <div class="row">
                        <div class="col-lg-4 mt-5">
                            {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><i class="mdi mdi-account text-primary"></i>
                                    Akun</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%cvx" disabled>
                                        <option value="AL">01</option>
                                        <option value="WY">02</option>
                                        <option value="AM">03</option>
                                        <option value="CA">04</option>
                                        <option value="RU">05</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="content">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="positive ui button">
                                    <a href="{{ route('create-penyesuaian') }}" class="btn btn-succes">Tambah<i
                                            class="mdi mdi-plus ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            {{-- <table class="table table-dark"> --}}
                            <table id="list-barang" class="table table-dark table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color:black" scope="col-md">Tanggal</th>
                                        <th style="background-color:black" scope="col-md">No Transaction</th>
                                        <th style="background-color:black" scope="col-md">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($jurnal_penyesuaians as $id)
                                        <tr>
                                            <td>{{ date('d-m-y', strtotime($id->date)) }}</td>
                                            <td>{{ $id->no_transaction }}</td>

                                            <td>
                                                <a href="{{ url('penyesuaian/editt-penyesuaian', $id->id) }}"
                                                    class="text-decoration-none link-light badge bg-primary border-0"><i
                                                        class="mdi mdi-file-document-edit-outline"></i></a>
                                                |
                                                <form action="{{ url('penyesuaian/delete-penyesuaian', $id->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0"
                                                        onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                                {{-- <i class="mdi mdi-trash-can-outline" style="color: red"></i></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
