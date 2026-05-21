<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Bookshop Home</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Sofia', cursive;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffe0ef, #fff5fa, #dcffe9);
            min-height: 100vh;
        }

        /* Navbar */
        nav {
            background-color: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

        /* Welcome section */
        .welcome-box {
            text-align: center;
            padding: 80px 20px 40px;
        }

        .welcome-box h1 {
            font-size: 65px;
            color: #06793f;
            text-shadow: 3px 3px 8px #9ff3c5;
            letter-spacing: 5px;
        }

        .welcome-box p {
            font-size: 24px;
            color: #444;
            margin-top: 20px;
        }

        /* Stats cards */
        .stats-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-10px);
        }

        .stats-icon {
            font-size: 50px;
        }

        .stats-card h2 {
            margin-top: 15px;
            color: #0b7d41;
        }

        /* Popular books */
        .section-title {
            text-align: center;
            font-size: 50px;
            color: #06793f;
            margin-top: 80px;
            margin-bottom: 50px;
            letter-spacing: 4px;
        }

        .book-card {
            background: white;
            border-radius: 25px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 20px;
        }

        .book-card h3 {
            margin-top: 15px;
            color: #06793f;
        }

        /* Quote */
        .quote-box {
            margin-top: 80px;
            text-align: center;
            font-size: 30px;
            color: #555;
            font-style: italic;
        }

        /* Logout button */
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

        .profile-btn{
    background-color:#ff9ec7;
    border:none;
    padding:10px 20px;
    border-radius:15px;
    font-size:18px;
    transition:0.3s;
}

.profile-btn:hover{
    background-color:#7de3a8;
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

    <!-- PROFILE DROPDOWN -->
   <div style="position:absolute; right:30px;">

    <div class="dropdown">

        <button class="profile-btn dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown">

            🌸 Profile

        </button>

        <div class="dropdown-menu p-3 text-center"
             style="
             min-width:280px;
             border-radius:20px;
             border:none;
             box-shadow:0 5px 20px rgba(0,0,0,0.15);
             background:white;
             ">

            <!-- PROFILE PICTURE -->

            @if(Auth::user()->profile_picture)

                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                     style="
                     width:90px;
                     height:90px;
                     border-radius:50%;
                     object-fit:cover;
                     border:4px solid #ffb6d9;
                     margin-bottom:10px;
                     ">

            @else

                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                     style="
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

            <a href="/profile"
               style="
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

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                    class="btn w-100"
                    style="
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


<div style="position:relative; display:inline-block; margin-left:15px;">

    <button onclick="toggleNotif()"
        style="
        background:#ff9ec7;
        border:none;
        padding:10px 15px;
        border-radius:12px;
        cursor:pointer;
        font-size:16px;
        position:relative;
        ">

        🔔

        @if($notifCount > 0)
        <span style="
            position:absolute;
            top:-5px;
            right:-5px;
            background:red;
            color:white;
            font-size:10px;
            padding:3px 6px;
            border-radius:50%;
        ">
            {{ $notifCount }}
        </span>
        @endif

    </button>

    <div id="notifBox"
    style="
    display:none;
    position:absolute;
    right:0;
    top:50px;
    width:320px;
    background:white;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
    max-height:400px;
    overflow-y:auto;
    z-index:999;
    ">

    <h4 style="padding:12px; margin:0; border-bottom:1px solid #eee;">
        🔔 Notifications
    </h4>

    @forelse($notifications->whereNull('read_at') as $n)

    @if($n->type == 'message')

        <a href="{{ url('/notification/read/' . $n->id) }}"
           style="display:block;padding:12px;text-decoration:none;color:black;">
            💬 <b>{{ $n->name }}</b> sent you a message
        </a>

    @elseif($n->type == 'friend_request')

        <div style="padding:12px;">

            👤 <b>{{ $n->name }}</b> sent you friend request

            <div style="margin-top:10px; display:flex; gap:10px;">

                <a href="{{ url('/friend/accept/' . $n->from_user_id) }}"
                   style="background:green;color:white;padding:6px 10px;border-radius:10px;">
                    Accept
                </a>

                <a href="{{ url('/friend/reject/' . $n->from_user_id) }}"
                   style="background:red;color:white;padding:6px 10px;border-radius:10px;">
                    Reject
                </a>

            </div>
        </div>

    @endif

@empty
    <p style="padding:10px;">No notifications 🌸</p>
@endforelse

</div>

</div>
</nav>

    <!-- WELCOME -->
    <section class="welcome-box">

        <h1>
            🌸 Welcome {{ Auth::user()->name }} 🌸
        </h1>

        <p>
            Discover your favourite books and enjoy reading today ✨</p>
           <p>From best-selling novels to legendary worlds brought to life on screen, explore books that shaped generations.
        </p>

    </section>

    <!-- STATS -->
    
    <!-- POPULAR BOOKS -->
    <section class="container">

        <h2 class="section-title">
           🌸 Popular Books 🌸
        </h2>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/91DdQ2QYaYL._SL1500_.jpg">

                    <h3>The Maze Runner</h3>

                    <p>
                        Survive the trials of The Maze Runner
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/91HHqVTAJQL.jpg">

                    <h3>Harry Potter</h3>

                    <p>
                        Step into the wizarding world of Harry Potter
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/814IqBLXacL._SL1500_.jpg">

                    <h3>Percy Jackson</h3>

                    <p>
                        Dive into Greek mythology with Percy Jackson & the Olympians
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- QUOTE -->
    <div class="quote-box">

        “Reading gives us somewhere to go when we have to stay where we are.” 📖

    </div>
@if(session('success'))
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
    <!-- FOOTER -->
    <footer>

        🌸 Thank you for visiting Bookshop 🌸

        <br><br>

        © 2026 Bookshop. All Rights Reserved.

    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>

function toggleNotif() {

    let box = document.getElementById('notifBox');

    if (box.style.display === 'none') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }

}

document.addEventListener('click', function(event) {

    let box = document.getElementById('notifBox');

    if (!event.target.closest('#notifBox') &&
        !event.target.closest('button')) {

        box.style.display = 'none';
    }

});

</script>
</body>

</html>