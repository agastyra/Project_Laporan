{{-- nanti kerjain yaa prass --}}
<x-layout.app>
    <h1>Hello show</h1>
    <ul>
        <li>{{ $akun->no_account }}</li>
        <li>{{ $akun->name_account }}</li>
        @if ($akun->is_header_account)
            <li>{{ $akun->is_header_account }}</li>
        @else
            <li>{{ $akun->header_account }}</li>
        @endif
        <li>{{ $akun->balance }}</li>
    </ul>
</x-layout.app>
