<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
        }

        .bg {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        }

        .card {
            width: 380px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #ff4d6d;
        }

        input {
            width: 90%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-family: 'Sofia', cursive;
        }

        button {
            background-color: #f3b8c3;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 80px;
            font-family: 'Sofia', cursive;
        }

        .text {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="bg">

    <div class="card">

        <h2>Forgot Password</h2>

        <p class="text">
            Enter your email and we’ll send you a reset link.
        </p>

        <!-- STATUS -->
        @if (session('status'))
            <p style="color:green; text-align:center;">
                {{ session('status') }}
            </p>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required autofocus>

            <br><br>

            <button type="submit" style="margin-left: 110px;">
                Send Reset Link
            </button>

        </form>

    </div>

</div>

</body>
</html>