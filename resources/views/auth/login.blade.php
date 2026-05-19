<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            font-size: 16px;
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
            margin-bottom: 20px;
            font-family: 'Sofia', cursive;
        }

        input[type="email"] {
            font-family: 'Sofia', cursive;
            border-radius: 8px !important;
            padding: 10px !important;
            border: 1px solid!important;
            width: 90% !important;
        }

        input[type="password"] {
            font-family: 'Sofia', cursive;
            border-radius: 8px !important;
            padding: 10px !important;
            border: 1px solid  !important;
            width: 90% !important;
        }

        button {
            font-family: 'Sofia', cursive;
            background-color: #f3b8c3;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 150px;
            padding-right: 20px;
            padding-left: 20px;
            
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

        <h2>Login</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
<br>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autofocus
                    autocomplete="current-password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
<br>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>
<br>
            <!-- Buttons -->
            <div class="flex items-center justify-between mt-4">

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}" style="text-decoration: none; color: #ff4d6d;">
                        Forgot password?
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    Log in
                </x-primary-button>

            </div>

        </form>

    </div>
</div>

</body>
</html>