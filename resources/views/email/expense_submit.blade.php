<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">


        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }

            tr:nth-child(even) {
              background-color: #dddddd;
            }
            </style>
</head>

<body style="text-align:center;font-family: Montserrat,sans-serif;line-height:1.5;">

    <div style="max-width:600px; margin: 0 auto;box-shadow: 0px 4px 5px 1px rgba(0, 0, 0, 0.16);">
        <div style="padding: 20px;text-align: left;">
            <p style="font-size: 13px;">Dear  {{$user_info['receiver']}}</p>

            <p style="font-size: 13px;">{{$user_info['sender']}} has submited the expense for your approval. </p>

            </p>
            <h2>Expense Detail</h2>
            <table>
                <tr>
                  <th style="text-align: right">Budget</th>
                  <th style="text-align: right">Submision</th>
                  <th style="text-align: right">Balance</th>
                </tr>
                <tr>
                  <td style="text-align: right">{{IND_money_format($user_info['budget'])}}</td>
                  <td style="text-align: right">{{IND_money_format($user_info['submission'])}}</td>
                  <td style="text-align: right">{{IND_money_format($user_info['balance'])}}</td>
                </tr>
            </table>

              <p style="font-size: 13px;">For login <a href="{{ route('employee.dashboard') }}">Click here</a></p>

            </p>
        </div>




    </div>

</body>

</html>
