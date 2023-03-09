<!DOCTYPE html>
<html>

<head>
  <title>
    Buku Besar
    @if($akun)
    | {{ $akun }}
    @else
    @endif
  </title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #FFFFFF;
    }

    h1,
    h3 {
      text-align: center;
      color: #333333;
      margin: 6pt 0;
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

    .idr {
      text-align: right;
    }

    .debit {
      color: #FF0000;
      text-align: right;
    }

    .credit {
      color: #00BFFF;
      text-align: right;
    }

    .balance {
      font-weight: bold;
      color: #E36425;
      text-align: right;
    }
  </style>
</head>

<body>
  <span>
    <h1>Toko Thrift Bismillah</h1>
  </span>
  <span>
    <h1>Buku Besar</h1>
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
  <h4>{{ $akun }}</h4>
  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Ref</th>
        <th>Debet</th>
        <th>Kredit</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($buku_besar as $detail)
      <tr>
        <td>{{ $detail->date }}</td>
        <td>{{ $detail->keterangan }}</td>
        <td>{{ $detail->no_account }}</td>
        <td>
          <div class="debit">
            @if ($detail->debet == '-')
            -
            @else
            Rp. {{ number_format($detail->debet, 0, ',', '.') }}
            @endif
          </div>
        </td>
        <td>
          <div class="credit">
            @if ($detail->kredit == '-')
            -
            @else
            Rp. {{ number_format($detail->kredit, 0, ',', '.') }}
            @endif
          </div>
        </td>
        <td>
          <div class="balance">Rp. {{ number_format($detail->saldo_akhir, 0, ',', '.') }}</div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6">Tidak ada transaksi</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</body>

</html>