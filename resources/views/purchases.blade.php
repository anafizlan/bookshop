<!DOCTYPE html>
<html>

<head>

    <title>Purchase</title>


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

        th {
            background: #ffc0dc;
            padding: 15px;
        }

        td {
            padding: 15px;
            text-align: center;
        }

        .buy-btn {
            background: green;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
        }

        input {
            padding: 5px;
            border-radius: 8px;
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
    <br>
    <h2>Purchase Books 📚</h2>
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Swal.fire({
                title: 'Payment Successful! 📚',
                text: '🌸 Thank you for purchasing with Bookshop 🌸',
                icon: 'success',
                confirmButtonColor: '#ff69b4',
                background: '#fff0f6',
                color: '#06793f',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


@if(Auth::user()->role_id == 1)
    <button class="btn btn-success" onclick="document.getElementById('addForm').style.display='block'">
        + Add Book
    </button>
@endif

@if(Auth::user()->role_id == 1)
<div id="addForm" style="display:none; margin-top:20px;">
    <form method="POST" action="/admin/book/add">
        @csrf

        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="stock" placeholder="Stock" required>

        <button type="submit" class="btn btn-primary">
            Add Book
        </button>
    </form>
</div>
@endif
    <table border="1">

        <tr>
            <th style="text-align:center;">Title</th>
            <th style="text-align:center;">Genre</th>
            <th style="text-align:center;">Author</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">Stock</th>
            <th style="text-align:center;">Action</th>
        </tr>

        @foreach ($books as $book)
            <tr>

                <td>{{ $book->title }}</td>

                <td>{{ $book->genre }}</td>

                <td>{{ $book->author }}</td>

                <td>RM {{ $book->price }}</td>

                <td>{{ $book->stock }}</td>


                @if (Auth::user()->role_id == 1)
                    <td>

                        <form method="POST" action="/admin/book/{{ $book->id }}">
                            @csrf
                            @method('PUT')

                            <input type="number" name="price" value="{{ $book->price }}" style="width:80px;">
                            <input type="number" name="stock" value="{{ $book->stock }}" style="width:80px;">

                            

                            <button type="submit" class="btn btn-sm btn-primary">
                                Save
                            </button>

                        </form>

                    </td>
                @endif

               

                    @if (Auth::user()->role_id != 1)
<td>
                        @if ($book->stock > 0)
                            @auth
                                <form method="POST" action="/buy/{{ $book->id }}">
                                    @csrf

                                    <input type="number" name="quantity" min="1" max="{{ $book->stock }}" value="1">

                                    <button type="submit" class="buy-btn">
                                        Buy
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    Register to Purchase
                                </a>
                            @endauth
                        @else
                            <span style="color:red;">Sold Out</span>
                        @endif
                    @endif

              </td>

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
