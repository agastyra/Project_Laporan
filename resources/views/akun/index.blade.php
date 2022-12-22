<<<<<<< HEAD
<x-layout.app>
<div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Small Table</h5>
			  <div class="table-responsive">
               <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
=======
{{-- Nanti pras kerjain tampilannya yaa --}}
<x-layout.app>
    <h1>Hello</h1>
    @forelse ($akuns as $akun)
        <ul>
            <li>{{ $akun->no_account }}</li>
            <li>{{ $akun->name_account }}</li>
        </ul>
    @empty
        <p>No data</p>
    @endforelse
>>>>>>> cbf5c9c9d4774734d2192155c0fc5da30c5474ae
</x-layout.app>
