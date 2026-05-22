<!DOCTYPE html>
<html>

<head>

    <title>My Bookshelf</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ffe6f2, #d8fff1);
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: green;
            font-size: 50px;
            margin-bottom: 40px;
            text-shadow: 2px 2px 5px #8fd19e;
        }

        .shelf {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .book-card {
            background: white;
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            text-align: center;
            border: 3px dashed #ffb6d9;
        }

        .book-card:hover {
            transform: translateY(-8px) scale(1.03);
        }

        .book-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 24px;
            color: #06793f;
            margin-bottom: 10px;
        }

        .qty {
            background: #fff0f7;
            padding: 8px;
            border-radius: 12px;
            margin-top: 10px;
        }

        .date {
            color: gray;
            font-size: 14px;
            margin-top: 15px;
        }

        .empty {
            text-align: center;
            font-size: 25px;
            color: gray;
            margin-top: 100px;
        }

        .back {
            display: inline-block;
           
            text-decoration: none;
            background: #ff9ec7;
            padding: 12px 20px;
            border-radius: 15px;
            color: black;
        }

        .receipt-btn{
    display:inline-block;
    margin-top:18px;
    background:#ffb6d9;
    color:black;
    text-decoration:none;
    padding:10px 18px;
    border-radius:15px;
    transition:0.3s;
    font-size:15px;
}

.receipt-btn:hover{
    background:#7de3a8;
    transform:scale(1.05);
}
    </style>

</head>

<body>

    <a href="/purchase" class="back">
        ← Back
    </a>

    <h1>
        📚 My Bookshelf
    </h1>

    @if ($orders->count() > 0)

        <div class="shelf">

            @foreach ($orders as $order)
                <div class="book-card">

                    <div class="book-icon">
                        📖
                    </div>

                    <div class="title">
                        {{ $order->book_title }}
                    </div>

                    <div class="qty">
                        Quantity: {{ $order->quantity }}
                    </div>

                    <div class="date">
                        Bought on:
                        <br>
                        {{ $order->created_at->format('d M Y') }}
                    </div>

                    <a href="/receipt/{{ $order->id }}" class="receipt-btn">
                        📄 Download Receipt
                    </a>

                </div>
            @endforeach

        </div>
    @else
        <div class="empty">

            😭 No books purchased yet

        </div>

    @endif

</body>

</html>
