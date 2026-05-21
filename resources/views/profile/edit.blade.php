<!DOCTYPE html>
<html>

<head>

    <title>My Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ffe0f0, #d9fff2);
            min-height: 100vh;
        }

        .container {
            width: 500px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        h2 {
            text-align: center;
            color: #06793f;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            color: #444;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-family: 'Sofia', cursive;
            font-size: 15px;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 15px;
            background: #ff8db3;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Sofia', cursive;
        }

        button:hover {
            background: #ff5f9e;
            transform: scale(1.02);
        }

        .danger {
            background: #ff4d6d;
        }

        .danger:hover {
            background: #e6395c;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
            border: 5px solid #ffb6d9;
        }

        .desc {
            text-align: center;
            color: gray;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <a href="{{ url('/home') }}" style="
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
    <div class="container">

        <!-- PROFILE CARD -->

        <div class="card">

            <h2>🌸 Edit Profile 🌸</h2>

            <p class="desc">
                Customize your profile for the Bookshop community ✨
            </p>

            @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="profile-pic">
            @else
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="profile-pic">
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                @csrf
                @method('patch')

                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" style="width:94%;">

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width:94%;">

                <label>Profile Picture</label>
                <input type="file" name="pfp" style="width:94%;" accept="image/*">

                <label>Bio</label>
                <textarea name="bio" style="width:94%;">{{ old('bio', $user->bio) }}</textarea>

                <button type="submit">Save Profile 🌸</button>

            </form>

        </div>

        <!-- PASSWORD CARD -->

        <div class="card">

            <h2>🔒 Change Password</h2>

            <form method="POST" action="{{ route('password.update') }}" style="width:94%;">

                @csrf
                @method('put')

                <label>Current Password</label>

                <input type="password" name="current_password" style="width:94%;">

                <label>New Password</label>

                <input type="password" name="password" style="width:94%;">

                <label>Confirm Password</label>

                <input type="password" name="password_confirmation" style="width:94%;">

                <button type="submit">

                    Update Password

                </button>

            </form>

        </div>

        <!-- DELETE ACCOUNT -->

        <div class="card">

            <h2>⚠ Delete Account</h2>

            <p class="desc">
                Once deleted, your account cannot be recovered.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">

                @csrf
                @method('delete')

                <label>Enter Password</label>

                <input type="password" name="password" style="width:94%;">

                <button type="submit" class="danger">

                    Delete My Account

                </button>

            </form>

        </div>

    </div>

</body>

</html>
