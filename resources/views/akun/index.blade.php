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
</x-layout.app>
