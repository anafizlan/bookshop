<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Sofia', cursive;
            background:linear-gradient(135deg,#ffe0f0,#d9fff2);
            padding:40px;
        }

        .card{
            max-width:700px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:25px;
            box-shadow:0 10px 20px rgba(0,0,0,0.1);
            text-align:center;
        }

        .pfp{
            width:140px;
            height:140px;
            border-radius:50%;
            object-fit:cover;
            border:5px solid #ffb6d9;
        }

        .genre{
            display:inline-block;
            background:#ffb6d9;
            padding:10px 20px;
            margin:5px;
            border-radius:20px;
        }

        .chat-btn{
            display:inline-block;
            margin-top:20px;
            background:#7de3a8;
            color:black;
            padding:12px 25px;
            border-radius:15px;
            text-decoration:none;
            font-size:18px;
        }

    </style>
</head>

<body>
<a href="{{ route('home') }}"
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
<div class="card">

    @if($user->profile_picture)

        <img src="{{ asset('storage/' . $user->profile_picture) }}"
             class="pfp">

    @else

        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
             class="pfp">

    @endif

    <h1>{{ $user->name }}</h1>

    <p>{{ $user->email }}</p>

    <p>
        {{ $user->bio ?? 'No bio yet 🌸' }}
    </p>

    <hr>

    <h2>📚 Favourite Genres</h2>

    @forelse($genres as $genre)

        <span class="genre">
            {{ $genre->genre }}
        </span>

    @empty

        <p>No genres yet 🌸</p>

    @endforelse

    <br>

    @if($isFriend)

    <a href="{{ url('/chat/' . $user->id) }}"
       class="chat-btn">

       💬 Chat

    </a>

@else

    <button
        style="
        margin-top:20px;
        background:gray;
        color:white;
        padding:12px 25px;
        border:none;
        border-radius:15px;
        font-size:18px;
        ">

        Add as friend to chat 🌸

    </button>

@endif
<hr style="margin-top:30px; margin-bottom:30px;">

<h2>📚 Books Read</h2>

<div style="
display:flex;
flex-wrap:wrap;
gap:20px;
justify-content:center;
margin-top:20px;
">

@forelse($books as $book)

    <div style="
    background:#fff0f6;
    padding:20px;
    border-radius:20px;
    width:200px;
    box-shadow:0 5px 10px rgba(0,0,0,0.1);
    ">

        <h3 style="color:#06793f;">
            {{ $book->title }}
        </h3>

        <p>
            ✍ {{ $book->author }}
        </p>

        <p>
            🎭 {{ $book->genre }}
        </p>

    </div>

@empty

    <p>No books yet 🌸</p>

@endforelse

</div>
</div>

</body>
</html>