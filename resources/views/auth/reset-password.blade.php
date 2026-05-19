<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>

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
            margin-bottom: 10px;
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
            font-family: 'Sofia', cursive;
            margin-left: 110px;
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="bg">

    <div class="card">

        <h2>Reset Password</h2>

        <form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" value="{{ $email ?? old('email') }}">

    <input type="password" name="password">

    <input type="password" name="password_confirmation">

    <button type="submit">Reset Password</button>
</form>

    </div>

</div>

</body>
</html>