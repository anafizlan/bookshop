<!DOCTYPE html>
<html>

<head>
    <title>Senarai Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <style>
        h2 {
            text-align: center;
            font-family: 'Sofia', cursive;
            letter-spacing: 5px;
            text-shadow: 2px 2px 5px green;
            font-variant: small-caps;
            font-size: 50px;
            color: green;
        }
    </style>
</head>

<body>

    <div class="container">
         <h2>User List</h2>
        <nav>
            <a href="{{ url('/') }}" class="home" style="margin-right: 50px;">Home</a>
            <a href="{{ url('/users') }}" class="home" style="margin-right: 50px;">Users</a>
            <a href="{{ url('/books') }}" class="home">Books</a>
            <a href="{{ url('/purchase') }}" class="home" style="margin-left: 50px;">Purchase</a>
        </nav>

       
       
               

                <table border="1" class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>
                                <a href="/delete/{{ $user->id }}" style="background:red; color:white; padding:5px 8px; text-decoration:none; border-radius:5px;" onclick="return confirm('Confirm delete?')">
                                    Delete
                                </a>
                                <a href="/edit/{{ $user->id }}" style="background:orange; color:white; padding:5px 8px; text-decoration:none;">
                                    Edit
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

</body>

</html>
