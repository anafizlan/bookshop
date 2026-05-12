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
    <style>
        * {
            font-family: 'Sofia', cursive;
        }
        .text4 {
            font-style: italic;
            display: inline-block;
            font-size: 18px;
             text-align: center;
        }
        #p1, #p2 {
            text-align: center;
            font-size: 25px;
            background-color: pink;
            border-radius: 10px;
        }

        h2 {
            color: #06793f;
            text-align: center;
            letter-spacing: 5px;
            text-shadow: 2px 2px 5px green;  
            font-variant: small-caps;
            font-size: 50px;
            font-family: 'Sofia', cursive;
        }

        fieldset {
            border: 10px groove pink;
            padding: 10px;
            font-weight: bold;
        }

       

      a.nav-link:link, a.nav-link:visited {
  background-color: pink;
  color: black;
  padding-right: 25px;
    padding-left: 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border: 3px solid pink;
  border-radius: 15px;
}

a.nav-link:hover, a.nav-link:active {
  background-color: #324567;
}
    </style>
</head>

<body>
    <div id = "container">

<h2>Bookshop</h2>
 <nav>
            <a href="{{ url('/') }}" class="home" style="margin-right: 50px;">Home</a>
            <a href="{{ url('/users') }}" class="home" style="margin-right: 50px;">Users</a>
            <a href="{{ url('/books') }}" class="home">Books</a>
            <a href="{{ url('/purchase') }}" class="home" style="margin-left: 50px;">Purchase</a>
        </nav>
        <main>
            
          
            <p id="p1" style="color:green;">🌸Welcome to our Bookshop!🌸</p>
            <p id="p2" style="color:green;">🌸Discover a wide range of books and enjoy reading.🌸</p>
            <p class="text4" style="font-size: 25px; background-color: pink; border-radius: 10px;"><strong>Please register to access our full collection. We look forward to serving you! Thank you for joining us! Happy reading!</strong></p>
            <div class="desktop">
                <form method="POST" action="/submit">
                    @csrf
                    <fieldset>
                        <legend>Register</legend>
                        Name: <input type="text" class="input-name" id="name" name="name"><br>
                        Email: <input type="email" class="input-email" id="email" name="email"><br>
                        Password: <input type="password" class="input-password" id="password" name="password"><br>
                    </fieldset>
                    <input type="submit" value="Register" style="background-color: #8adbb3; color: black; padding-left:20px; padding-right: 20px; border: none; border-radius: 5px; cursor: pointer;">
                </form>
                @if (session('success'))
                    <div id="popup" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
">

                        <div style="
        background: white;
        width: 300px;
        margin: 100px auto;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
       
    ">
                            <style>
                                h3:after {
                                    content: ' \2764';
                                }
                            </style>
                            <h3>Thank you for registering!</h3>
                            <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExeHc2M2p0dWRjN3pnNjR4c2IwNWduMG9wa2xkMmJhOGJpc2s4Nmk4MyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/NFA61GS9qKZ68/giphy.gif" width="200">
                            <br>

                            <button onclick="closePopup()">OK</button>
                        </div>

                    </div>
                @endif
                <footer>
                    &copy; Copyright 2025. All Right Reserved. <br>
                    <a href=mailto:"anafizlan01@gmail.com" class="nav-link">PRESS ME</a>
                </footer>
            </div>

            <script>
                function closePopup() {
                    document.getElementById('popup').style.display = 'none';
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
            </script>
        </main>
    </div>
</body>

</html>
