<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<style>
    .back {
            display: inline-block;
           
            text-decoration: none;
            background: #ff9ec7;
            padding: 12px 20px;
            border-radius: 15px;
            color: black;
        }
</style>

<body style="background:#fff5fa;">

<div class="container py-5">

    <a href="/purchase" class="back">
        ← Back
    </a>
    <h1 class="mb-5 text-center">
        🌸 Admin Dashboard 🌸
    </h1>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-4 shadow border-0 rounded-4 text-center">
                <h3>Total Users</h3>
                <h1>{{ $totalUsers }}</h1>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow border-0 rounded-4 text-center">
                <h3>Books Sold</h3>
                <h1>{{ $totalBooksSold }}</h1>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow border-0 rounded-4 text-center">
                <h3>Total Revenue</h3>
                <h1>RM {{ $totalRevenue }}</h1>
            </div>
        </div>

    </div>

    <div class="row mt-5">

        <div class="col-md-6">

            <div class="card p-4 shadow border-0 rounded-4">

                <h3 class="mb-4 text-center">
                    Genre Purchases
                </h3>

                <canvas id="genreChart"></canvas>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card p-4 shadow border-0 rounded-4">

                <h3 class="mb-4 text-center">
                    Popular Books
                </h3>

                @foreach($popularBooks as $book)

                    <div class="mb-3">

                        <b>{{ $book->title }}</b>

                        <div>
                            Purchased {{ $book->total }} times
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

<script>

const genreLabels = [
    @foreach($genreStats as $genre)
        "{{ $genre->genre }}",
    @endforeach
];

const genreData = [
    @foreach($genreStats as $genre)
        {{ $genre->total }},
    @endforeach
];

new Chart(document.getElementById('genreChart'), {

    type: 'pie',

    data: {

        labels: genreLabels,

        datasets: [{

            data: genreData

        }]

    }

});

</script>

</body>
</html>