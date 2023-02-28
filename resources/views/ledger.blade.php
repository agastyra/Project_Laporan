<!DOCTYPE html>
<html>
  <head>
    <title>My Ledger</title>
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
    <h1>My Ledger</h1>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Description</th>
          <th>Debit</th>
          <th>Credit</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2022-01-01</td>
          <td>Opening Balance</td>
          <td></td>
          <td class="credit">1000.00</td>
        </tr>
        <tr>
          <td>2022-01-05</td>
          <td>Salary</td>
          <td></td>
          <td class="credit">500.00</td>
        </tr>
        <tr>
          <td>2022-01-10</td>
          <td>Office Rent</td>
          <td class="debit">300.00</td>
          <td></td>
        </tr>
        <tr>
          <td>2022-01-15</td>
          <td>Internet Bill</td>
          <td class="debit">50.00</td>
          <td></td>
        </tr>
        <tr>
          <td>2022-01-20</td>
          <td>Utility Bill</td>
          <td class="debit">100.00</td>
          <td></td>
        </tr>
        <tr>
          <td>2022-01-25</td>
          <td>Client Payment</td>
          <td class="debit">500.00</td>
          <td></td>
        </tr>
        <tr>
          <td>2022-01-31</td>
          <td>Office Supplies</td>
          <td class="debit">50.00</td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>Ending Balance</td>
          <td class="debit balance">900.00</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
