<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>Bookshop</title>
    <meta charset="utf-8">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 style="text-align: center; font-family: 'Sofia', cursive; letter-spacing: 5px; text-shadow: 2px 2px 5px green; font-variant: small-caps; font-size: 50px; color: green;">
        Purchase Books
    </h2>

    <nav>
      <a href="{{ url('/') }}" class="home" style="margin-right: 50px;">Home</a>
            <a href="{{ url('/users') }}" class="home" style="margin-right: 50px;">Users</a>
            <a href="{{ url('/books') }}" class="home">Books</a>
            <a href="{{ url('/purchase') }}" class="home" style="margin-left: 50px;">Purchase</a>
    </nav>
   
@if(session('success'))
<script>
Swal.fire({
    title: 'Success!',
    text: 'Book purchased successfully 📚',
    icon: 'success',
    showConfirmButton: false,
    timer: 1800,
    background: '#f0fff4',
    color: '#14532d'
});
</script>
@endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Author</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($purchases as $purchase)

        <tr>
            <td>{{ $purchase->title }}</td>
            <td>{{ $purchase->genre }}</td>
            <td>{{ $purchase->author }}</td>
            <td>RM {{ $purchase->price }}</td>
            <td>{{ $purchase->stock }}</td>

            <td>
                @if($purchase->stock > 0)
                    <span class="badge bg-success">Available</span>
                @else
                    <span class="badge bg-danger">Unavailable</span>
                @endif
            </td>

            <td>
                @if($purchase->stock > 0)

                    <form action="/buy/{{ $purchase->id }}" method="POST">
                        @csrf

                        <input type="number"
                               name="quantity"
                               min="1"
                               max="{{ $purchase->stock }}"
                               value="1">

                        <button type="submit" class="btn btn-primary">
                            Buy
                        </button>
                    </form>

                @else

                    <button class="btn btn-secondary" disabled>
                        Sold Out
                    </button>

                @endif
            </td>
        </tr>

        @endforeach

    </table>

</div>

</body>
</html>