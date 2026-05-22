<!DOCTYPE html>
<html>

<head>

    <title>Bookshop Receipt</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #fff5fa;
            padding: 40px;
            color: #333;
        }

        .receipt-box {
            max-width: 700px;
            margin: auto;
            background: white;
            border-radius: 25px;
            padding: 40px;
            border: 4px dashed #ffb6d9;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .top {
            text-align: center;
            margin-bottom: 30px;
        }

        .top h1 {
            color: #06793f;
            font-size: 40px;
            margin-bottom: 5px;
        }

        .top p {
            color: gray;
            font-size: 14px;
        }

        .line {
            border-top: 2px dashed #ffc0dc;
            margin: 25px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #ffb6d9;
            color: black;
            padding: 14px;
            text-align: left;
            border-radius: 10px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        .total-box {
            margin-top: 30px;
            text-align: right;
        }

        .total {
            font-size: 28px;
            color: #06793f;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: gray;
            font-size: 14px;
        }

        .paid {
            display: inline-block;
            background: #d8fff1;
            color: green;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>

</head>

<body>

    <div class="receipt-box">

        <div class="top">

            <h1>
                 BOOKSHOP
            </h1>

            <p>
                Payment Receipt
            </p>

            <div class="paid">
                 PAYMENT SUCCESSFUL
            </div>

        </div>

        <div class="line"></div>

        <table>

            <tr>
                <th>Customer</th>
                <td>{{ Auth::user()->name }}</td>
            </tr>

            <tr>
                <th>Book Title</th>
                <td>{{ $order->book_title }}</td>
            </tr>

            <tr>
                <th>Quantity</th>
                <td>{{ $order->quantity }}</td>
            </tr>

            <tr>
                <th>Purchase Date</th>
                <td>{{ $order->created_at }}</td>
            </tr>

        </table>

        <div class="total-box">

            <p>Total Paid</p>

            <div class="total">
                RM {{ number_format($order->total_price, 2) }}
            </div>

        </div>

        <div class="footer">

             Thank you for purchasing with Bookshop 

        </div>

    </div>

</body>

</html>
