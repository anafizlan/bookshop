<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>Bookshop</title>
    <meta charset= "utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="card" style="background-color: #f751ec7a; width: 30rem; margin: 50px auto; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: 'Sofia', cursive;">

  <div class="card-body">
    <h2 style="text-align: center; color: green;">Payment Page</h2>
   <p style="font-size: 20px; font-weight: bold; text-align: center; color: #062c0e;">Book: {{ $book->title }}</p>
   <p style="font-size: 20px; text-align: center; font-weight: bold; color: #062c0e;">Quantity: {{ $qty }}</p>
   <p style="font-size: 20px; text-align: center; font-weight: bold; color: #062c0e;">Total: RM {{ $total }}</p>
  </div>



<form action="/payment/{{ $book->id }}" method="POST">
    @csrf

    <input type="hidden" name="quantity" value="{{ $qty }}">
    <input type="hidden" name="total" value="{{ $total }}">

    <button type="submit" class="btn btn-primary" style="text-align: center; background-color: green; border-style: none;">Pay Now</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</script>
</body>
</html>
