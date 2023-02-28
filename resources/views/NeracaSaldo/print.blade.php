<!DOCTYPE html>
<html>
  <head>
    <title>Neraca Saldo</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #F7F7F7;
      }

      h1 {
        text-align: center;
        color: #333333;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px auto;
        background-color: #FFFFFF;
        box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.2);
      }

      th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #CCCCCC;
      }

      th {
        background-color: #F5F5F5;
        font-weight: bold;
      }

      tbody tr:hover {
        background-color: #F2F2F2;
      }

      .debit {
        color: #FF0000;
      }

      .credit {
        color: #00BFFF;
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
        <h1>Bulan </h1>
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
          <td class="debit">1000.000</td>
          <td class="credit"></td>
        </tr>
        <tr>
          <td>202</td>
          <td>Salary</td>
          <td class="debit"></td>
          <td class="credit">500.000</td>
        </tr>
        <tr>
          <td></td>
          <td>Total</td>
          <td class="debit balance"></td>
          <td class="credit balance">600.000</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
