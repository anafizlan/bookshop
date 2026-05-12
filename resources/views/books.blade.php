<h2>Recommended Books</h2>
 <nav>
            <a href="{{ url('/') }}" class="home" style="margin-right: 50px;">Home</a>
            <a href="{{ url('/users') }}" class="home" style="margin-right: 50px;">Users</a>
            <a href="{{ url('/books') }}" class="home">Books</a>
            <a href="{{ url('/purchase') }}" class="home" style="margin-left: 50px;">Purchase</a>
        </nav>

   <style>

   h2{
        text-align: center;
        font-family: 'Sofia', cursive;
        letter-spacing: 5px;
            text-shadow: 2px 2px 5px green;  
            font-variant: small-caps;
            font-size: 50px;
            color: green;
    }
   </style>
   <link rel = "stylesheet" href= "{{ asset('assets/css/styles.css') }}">   
       <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
<p style="font-family: 'Sofia', cursive; letter-spacing: 5px;">Genre: {{ $genre }}</p>

@if($books->isEmpty())
    <p>No books found 😢</p>
@else
<form method="GET" action="{{ url('/books') }}">
    <select name="genre" style="font-family: 'Sofia', cursive; letter-spacing: 5px; background-color: pink; border-width:2px; border-radius: 10px;">
        <option value="">-- Select Genre --</option>
        <option value="Horror">Horror</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Romance">Romance</option>
    </select>

    <button type="submit" style="background-color: pink; border-width:2px; border-radius: 10px;">Search</button>
</form>
<table border="1">
<tr>
    <th>Title</th>
    <th>Genre</th>
    <th>Author</th>
</tr>

@foreach($books as $book)
<tr>
    <td>{{ $book->title }}</td>
    <td>{{ $book->genre }}</td>
    <td>{{ $book->author }}</td>
</tr>
@endforeach

</table>

@endif