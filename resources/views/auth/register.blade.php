<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        }

        .bg {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-family: 'Sofia', cursive;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #f3b8c3;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Sofia', cursive;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: #ff4d6d;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
<a href="{{ route('landing') }}"
   style="
        position: absolute;
        top: 20px;
        left: 20px;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        text-decoration: none;
        color: #ff4d6d;
        font-size: 20px;
   ">
    🏠
</a>
<div class="bg">

    <div class="card">

        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Password</label>
            <input type="password" name="password" required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">
                Register
            </button>

            <div class="login-link">
                <a href="{{ route('login') }}">
                    Already registered?
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>