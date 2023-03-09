<!DOCTYPE html>
<html>

<head>
    <title>Neraca Saldo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
        }

        h1 {
            text-align: center;
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
        <h1>Bulan {{ 'Isi Bulan' }}</h1>
    </span>
    <span>
        <h1>Neraca Saldo</h1>
    </span>
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
            <tr>
                <td>1001</td>
                <td>Kas</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit"></div>
                </td>
            </tr>
            <tr>
                <td>1001</td>
                <td>Kas</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit balance"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit balance"></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Neraca Saldo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
        }

        h1 {
            text-align: center;
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
        <h1>Bulan {{ 'Isi Bulan' }}</h1>
    </span>
    <span>
        <h1>Neraca Saldo</h1>
    </span>
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
            <tr>
                <td>1001</td>
                <td>Kas</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit"></div>
                </td>
            </tr>
            <tr>
                <td>1001</td>
                <td>Kas</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="debit balance"> 1000.000</div>
                </td>
                <td>
                    <div class="idr">Rp.</div>
                    <div class="credit balance"></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
