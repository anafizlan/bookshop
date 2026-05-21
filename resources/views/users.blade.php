<!DOCTYPE html>
<html>

<head>
    <title>User Community</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Sofia', cursive;
            margin: 0;
            background: linear-gradient(135deg, #ffe0f0, #d9fff2);
        }

        * {
            font-family: 'Sofia', cursive;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: green;
            font-size: 50px;
            letter-spacing: 5px;
            text-shadow: 2px 2px 5px green;
            font-family: 'Sofia', cursive;
        }

        .desc {
            text-align: center;
            background: white;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        nav {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        nav a {
            text-decoration: none;
            margin: 15px;
            padding: 10px 25px;
            background-color: #ff9ec7;
            color: black;
            border-radius: 15px;
            transition: 0.3s;
            font-size: 18px;
        }

        nav a:hover {
            background-color: #7de3a8;
            transform: scale(1.05);
        }


        table {
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        th {
            background: #ffb6d9;
            padding: 15px;
        }

        td {
            padding: 15px;
            text-align: center;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-btn button {
            background-color: #ff5f7e;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: 0.3s;
        }

        .logout-btn button:hover {
            background-color: #ff2f5c;
        }

        footer {
            text-align: center;
            margin-top: 80px;
            padding: 30px;
            background-color: #ffcde1;
            font-size: 18px;
        }

        .profile-btn {
            background-color: #ff9ec7;
            border: none;
            padding: 10px 20px;
            border-radius: 15px;
            font-size: 18px;
            transition: 0.3s;
        }

        .profile-btn:hover {
            background-color: #7de3a8;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav style="display:flex; justify-content:center; align-items:center; position:relative;">

        <a href="{{ url('/home') }}">
            Home
        </a>

        <a href="{{ url('/users') }}">

            @if (Auth::user()->role_id == 1)
                Users
            @else
                Friends
            @endif

        </a>

        <a href="{{ url('/books') }}">
            Books
        </a>

        <a href="{{ url('/purchase') }}">
            Purchase
        </a>
        @include('partials.notification')
        </div>
        </div>


        <div style="position:absolute; right:30px;">

            <div class="dropdown">

                <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">

                    🌸 Profile

                </button>

                <div class="dropdown-menu p-3 text-center" style="
             min-width:280px;
             border-radius:20px;
             border:none;
             box-shadow:0 5px 20px rgba(0,0,0,0.15);
             background:white;
             ">

                    <!-- PROFILE PICTURE -->

                    @if (Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" style="
                     width:90px;
                     height:90px;
                     border-radius:50%;
                     object-fit:cover;
                     border:4px solid #ffb6d9;
                     margin-bottom:10px;
                     ">
                    @else
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" style="
                     width:90px;
                     height:90px;
                     border-radius:50%;
                     border:4px solid #ffb6d9;
                     margin-bottom:10px;
                     ">
                    @endif


                    <!-- NAME -->

                    <h5 style="color:#06793f; margin-bottom:5px;">
                        {{ Auth::user()->name }}
                    </h5>


                    <!-- EMAIL -->

                    <p style="
               font-size:13px;
               color:gray;
               margin-bottom:10px;
               ">
                        {{ Auth::user()->email }}
                    </p>


                    <!-- BIO -->

                    <div style="
                 background:#fff0f6;
                 padding:10px;
                 border-radius:12px;
                 font-size:13px;
                 margin-bottom:15px;
                 color:#444;
                 ">

                        {{ Auth::user()->bio ?? 'No bio yet 🌸' }}

                    </div>


                    <!-- EDIT PROFILE -->

                    <a href="/profile" style="
               display:block;
               text-decoration:none;
               background:#ffb6d9;
               color:black;
               padding:10px;
               border-radius:12px;
               margin-bottom:10px;
               font-weight:bold;
               ">

                        Edit Profile

                    </a>



                    <!-- LOGOUT -->

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit" class="btn w-100" style="
                    background-color:#ff4d6d;
                    color:white;
                    border:none;
                    border-radius:12px;
                    padding:10px;
                    ">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>


    </nav>

    <div class="container">

        <h2>User Community</h2>

        <div class="desc">
            🌸 This page allows book readers to communicate and connect with other users.
            You can also edit your own information here!
        </div>

        @if ($friends->count() > 0)

            <div style="
            background:white;
            padding:20px;
            border-radius:20px;
            margin-bottom:30px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            ">

                <h3 style="color:#06793f; margin-bottom:20px;">
                    🌸 Your Friends
                </h3>

                <div style="
                display:flex;
                gap:20px;
                flex-wrap:wrap;
                ">

                    @foreach ($friends as $friend)
                        <div style="text-align:center;">

                            @if (!empty($friend->profile_picture))
                                <img src="{{ asset('storage/' . $friend->profile_picture) }}" style="
                     width:80px;
                     height:80px;
                     border-radius:50%;
                     object-fit:cover;
                     border:4px solid #ffb6d9;
                     ">
                            @else
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" style="
                     width:80px;
                     height:80px;
                     border-radius:50%;
                     border:4px solid #ffb6d9;
                     ">
                            @endif

                            <p style="margin-top:10px;">
                                <a href="{{ url('/user/' . $friend->id) }}" style="
                                    text-decoration:none;
                                    color:#06793f;
                                    font-weight:bold;
                                    ">

                                    {{ $friend->name }}

                                </a>
                            </p>

                        </div>
                    @endforeach

                </div>

            </div>

        @endif

        <table border="1">

            <tr>
                <th style="text-align:center;">Profile</th>
                <th style="text-align:center;">Username</th>
                <th style="text-align:center;">Email</th>
                <th style="text-align:center;">Bio</th>
                <th style="text-align:center;">Action</th>
            </tr>

            @foreach ($users as $user)

                @if ($user->id != Auth::id())
                    <tr>

                        <!-- PROFILE PICTURE -->

                        <td>

                            @if (!empty($user->profile_picture))
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" style="
                     width:70px;
                     height:70px;
                     border-radius:50%;
                     object-fit:cover;
                     border:3px solid #ffb6d9;
                     ">
                            @else
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" style="
                     width:70px;
                     height:70px;
                     border-radius:50%;
                     border:3px solid #ffb6d9;
                     ">
                            @endif

                        </td>


                        <!-- USERNAME -->

                        <td>
                            {{ $user->name }}
                        </td>


                        <!-- EMAIL -->

                        <td>
                            {{ $user->email }}
                        </td>


                        <!-- BIO -->

                        <td>
                            {{ $user->bio ?? 'No bio yet 🌸' }}
                        </td>


                        <!-- ADD FRIEND BUTTON -->

                        <td>

                            @if (Auth::user()->role_id == 1)
                                <a href="{{ url('/admin/users/edit/' . $user->id) }}" style="
       background:#7de3a8;
       padding:8px 12px;
       border-radius:10px;
       text-decoration:none;
       color:black;
       ">
                                    Edit
                                </a>
@if(Auth::id() != $user->id)
                                <form action="{{ url('/admin/users/delete/' . $user->id) }}" method="POST" style="margin-top:10px;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Delete this user?')" style="
                                                background:#ff4d6d;
                                                color:white;
                                                border:none;
                                                padding:8px 12px;
                                                border-radius:10px;
                                                ">
                                         Delete
                                    </button>
@endif
                                </form>
                            @else
                                @php
                                    $friendship = DB::table('friends')->where('user_id', Auth::id())->where('friend_id', $user->id)->first();
                                @endphp

                                @if ($friendship)
                                    @if ($friendship->status == 'pending')
                                        <form action="{{ url('/cancel-friend/' . $user->id) }}" method="POST">

                                            @csrf

                                            <button type="submit" style="
                    background:gray;
                    color:white;
                    border:none;
                    padding:10px 18px;
                    border-radius:12px;
                    ">

                                                Cancel Request

                                            </button>

                                        </form>
                                    @elseif($friendship->status == 'accepted')
                                        <form action="{{ url('/unfriend/' . $user->id) }}" method="POST">

                                            @csrf

                                            <button type="submit" style="
                    background:#ff9ec7;
                    color:black;
                    border:none;
                    padding:10px 18px;
                    border-radius:12px;
                    font-weight:bold;
                    ">

                                                Unfriend 💔

                                            </button>

                                        </form>
                                    @endif
                                @else
                                    <form action="{{ url('/add-friend/' . $user->id) }}" method="POST">

                                        @csrf

                                        <button type="submit" style="
                background:#7de3a8;
                color:black;
                border:none;
                padding:10px 18px;
                border-radius:12px;
                font-weight:bold;
                ">

                                            Add Friend

                                        </button>

                                    </form>
                                @endif
                            @endif

                        </td>

                    </tr>
                @endif

            @endforeach

        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif


</body>

</html>
