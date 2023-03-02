<!DOCTYPE html>
<html>

<head>
    <title>Toko Thrift Bismillah | Jurnal Umum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFFs;
        }

        h1,
        h3 {
            text-align: center;
            margin: 6pt 0;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
            background-color: #FFFFFF;
            box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            padding: 10px;
            /* text-align: left; */
            border-bottom: 1px solid #CCCCCC;
        }

        th {
            background-color: #F5F5F5;
            font-weight: bold;
        }

        tbody tr:hover {
            background-color: #F2F2F2;
        }

        .tanggal {
            width: 15%;
        }

        .no_akun {
            width: 15%;
        }

        .idr {
            text-align: right;
            display: inline-block;
        }

        .debit {
            color: #FF0000;
            text-align: right;
            display: inline-block;
        }

        .credit {
            color: #00BFFF;
            text-align: right;
            display: inline-block;
        }

        .balance {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <span>
        <h1>Toko Thrift Bismillah</h1>
    </span>
    <span>
        <h1>Jurnal Umum</h1>
    </span>
    @if (!is_null($tanggal_awal) && !is_null($tanggal_akhir))
        <span>
            <h3>Periode {{ $tanggal_awal }} s.d {{ $tanggal_akhir }}</h3>
        </span>
    @else
        <span>
            <h3>Semua periode</h3>
        </span>
    @endif
    <table>
        <thead>
            <tr>
                <th class="tanggal">Tanggal</th>
                <th class="no_akun">No. Akun</th>
                <th>Nama Akun</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurnal_memorials as $jurnal_memorial)
                <tr>
                    <td class="tanggal">{{ $jurnal_memorial->jurnal_tanggal }}</td>
                    <td class="no_akun">{{ $jurnal_memorial->no_akun }}</td>
                    <td>{{ $jurnal_memorial->nama_akun }}</td>
                    <td>
                        <div class="idr">Rp.</div>
                        <div class="debit">{{ number_format($jurnal_memorial->debet, 0, ',', '.') }}</div>
                    </td>
                    <td>
                        <div class="idr">Rp.</div>
                        <div class="credit">{{ number_format($jurnal_memorial->kredit, 0, ',', '.') }}</div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
