<!DOCTYPE html>
<html>

<head>

    <title>Books</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ffe6f2, #d8fff1);
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

        .top-box {

            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        select,
        button {
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-family: 'Sofia', cursive;
        }

        button {
            background: #ff69b4;
            color: white;
        }

        table {
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        th {
            background: #ffc0dc;
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

    <div class="logout-btn">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit">
                Logout
            </button>
        </form>

    </div>

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
        <!-- PROFILE DROPDOWN -->
        <div style="position:absolute; right:30px;">

            <div class="dropdown">

                <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" style="color:black;">

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

                    @if (Auth::user()?->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()?->profile_picture) }}" style="
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
                        {{ Auth::user()?->name }}
                    </h5>


                    <!-- EMAIL -->

                    <p style="
               font-size:13px;
               color:gray;
               margin-bottom:10px;
               ">
                        {{ Auth::user()?->email }}
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

                        {{ Auth::user()?->bio ?? 'No bio yet 🌸' }}

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
    <br>
    <h2>Recommended Books 📚</h2>
    </div>
    <div class="top-box">

        <p>🌸 Discover amazing books from different genres 🌸</p>

        <form method="GET" action="/books">

            <div style="
            display:flex;
            justify-content:center;
            flex-wrap:wrap;
            gap:12px;
            margin-top:20px;
        ">

                @foreach ($genres as $g)
                    <label style="
                    background:white;
                    padding:10px 15px;
                    border-radius:15px;
                    box-shadow:0 3px 8px rgba(0,0,0,0.1);
                    cursor:pointer;
                    transition:0.2s;
                ">

                        <input type="checkbox" name="genres[]" value="{{ $g->genre }}" style="margin-right:8px;">

                        {{ $g->genre }}

                    </label>
                @endforeach

            </div>

            <br>

            <button type="submit" style="
            background:#ff69b4;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:15px;
            font-size:18px;
            ">
                Search
            </button>

        </form>

    </div>
    <table border="1">

        <tr>
            <th style="text-align: center">Title</th>
            <th style="text-align: center">Genre</th>
            <th style="text-align: center">Author</th>

            @if (Auth::user()->role_id == 1)
                <th style="text-align: center">Action</th>
            @endif
        </tr>

        @foreach ($books as $book)
            <tr>

                <td>{{ $book->title }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->author }}</td>

                @if (Auth::user()->role_id == 1)
                    <td>

                        @if ($book->is_visible)
                            <form method="POST" action="{{ url('/books/hide/' . $book->id) }}">
                                @csrf
                                <button style="background:red;color:white;padding:5px 10px;border:none;border-radius:8px;">
                                    Hide
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ url('/books/show/' . $book->id) }}">
                                @csrf
                                <button style="background:green;color:white;padding:5px 10px;border:none;border-radius:8px;">
                                    Show
                                </button>
                            </form>
                        @endif

                    </td>
                @endif

            </tr>
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
