<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ffe0f0, #d9fff2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            width: 400px;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        h2 {
            text-align: center;
            color: #06793f;
            margin-bottom: 30px;
            font-size: 35px;
            letter-spacing: 2px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-size: 18px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 2px solid #ffd3e2;
            margin-bottom: 20px;
            font-family: 'Sofia', cursive;
            font-size: 16px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #7de3a8;
        }

        .update-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 15px;
            background: #7de3a8;
            color: black;
            font-size: 18px;
            font-family: 'Sofia', cursive;
            cursor: pointer;
            transition: 0.3s;
        }

        .update-btn:hover {
            background: #5fd18d;
            transform: scale(1.03);
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            background: #ffb6d9;
            padding: 10px;
            border-radius: 12px;
            color: black;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #ff9ec7;
        }
    </style>
</head>

<body>

    <div class="card">

        <h2>🌸 Edit User</h2>

        <form method="POST" action="{{ url('/admin/users/update/' . $user->id) }}">

            @csrf
            @method('PUT')

            <label>Name</label>

            <input type="text" name="name" value="{{ $user->name }}" style="width: 93%;">

            <label>Email</label>

            <input type="email" name="email" value="{{ $user->email }}" style="width: 93%;">
            @if (Auth::id() != $user->id)
                <label>Role</label>

                <select name="role_id">

                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>
                        User
                    </option>

                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>
                        Admin
                    </option>

                </select>
            @endif

            <button type="submit" class="update-btn">
                Update User
            </button>

        </form>

        <a href="{{ url('/users') }}" class="back-btn">
            ← Back
        </a>

    </div>

</body>

</html>
