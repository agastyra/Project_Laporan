<!DOCTYPE html>
<html>

<head>
  <title>{{ $title }}</title>
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
      border: 1px solid #CCCCCC;
    }

    th {
      background-color: #F5F5F5;
      font-weight: bold;
    }

    tbody tr:hover {
      background-color: #F2F2F2;
    }

    .idr {
      text-align: left;
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
    }
  </style>
</head>

<body>
  <span>
    <h1>Toko Thrift Bismillah</h1>
  </span>
  <span>
    <h1>Neraca Saldo</h1>
  </span>
  @if (!is_null($bulan))
  <span>
    <h3>Periode {{ $bulan }}</h3>
  </span>
  @else
  <span>
    <h3>Semua periode</h3>
  </span>
  @endif
  <table>
    <thead>
      <tr>
        <th>No. Akun</th>
        <th>Nama Akun</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
    </thead>
    <tbody>
      @forelse($neraca_saldo as $detail)
      <tr>
        <td>{{ $detail->no_account }}</td>
        <td>{{ $detail->name_account }}</td>
        <td class="debit">@if ($detail->debet == '-')
          -
          @else
          Rp. {{ number_format((float) $detail->debet, 0, ',', '.') }}
          @endif
        </td>
        <td class="credit">@if ($detail->kredit == '-')
          -
          @else
          Rp. {{ number_format((float) $detail->kredit, 0, ',', '.') }}
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4">Tidak ada akun yang tersedia</td>
      </tr>
      @endforelse
    </tbody>
    <tfoot>
      <th colspan="2">Total</th>
      <th style="text-align: 'left;'">Rp. {{ number_format((float) $sumDebet, 0, ',', '.') }}</th>
      <th style="text-align: 'left;'">Rp. {{ number_format((float) $sumKredit, 0, ',', '.') }}</th>
    </tfoot>
  </table>
</body>

</html>