<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>Payment Page</title>

    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            margin:0;
            font-family:'Sofia', cursive;
            background:linear-gradient(135deg,#ffe6f2,#d8fff1);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .payment-card{
            width:420px;
            background:white;
            padding:35px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
            text-align:center;
            animation:fadeIn 1s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(20px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        h2{
            color:green;
            font-size:40px;
            letter-spacing:3px;
            margin-bottom:25px;
            text-shadow:2px 2px 5px #8fd19e;
        }

        .book-icon{
            font-size:60px;
            margin-bottom:10px;
        }

        .info-box{
            background:#fff0f7;
            padding:15px;
            border-radius:15px;
            margin-bottom:15px;
            box-shadow:0 3px 10px rgba(0,0,0,0.05);
        }

        .info-box p{
            margin:10px 0;
            font-size:20px;
            color:#14532d;
        }

        .pay-btn{
            background:linear-gradient(135deg,#ff69b4,#ff9ecf);
            color:white;
            border:none;
            padding:12px 30px;
            border-radius:15px;
            font-size:18px;
            cursor:pointer;
            transition:0.3s;
            margin-top:20px;
        }

        .pay-btn:hover{
            transform:scale(1.05);
            background:linear-gradient(135deg,#ff4fa3,#ff85c2);
        }

        .back-btn{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:green;
        }

    </style>

</head>

<body>

<div class="payment-card">

    <div class="book-icon">
        📚
    </div>

    <h2>Payment Page</h2>

    <div class="info-box">

        <p>
            <strong>Book:</strong>
            {{ $book->title }}
        </p>

        <p>
            <strong>Quantity:</strong>
            {{ $qty }}
        </p>

        <p>
            <strong>Total:</strong>
            RM {{ $total }}
        </p>

    </div>

    <form method="POST" action="/confirm-payment/{{ $book->id }}">

        @csrf

        <input type="hidden" name="quantity" value="{{ $qty }}">

        <input type="hidden" name="total" value="{{ $total }}">

        <button type="submit" class="pay-btn">
            💳 Pay Now
        </button>

    </form>

    <a href="/purchase" class="back-btn">
        ← Back to Purchase
    </a>

</div>

</body>
</html>