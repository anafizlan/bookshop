<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Bookshop Landing Page</title>

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
            overflow-x: hidden;
            background: linear-gradient(135deg, #ffd6e7, #ffeef5, #d9ffe8);
            min-height: 100vh;
        }

        /* Floating animation */
        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Hero section */
        .hero {
            text-align: center;
            padding-top: 120px;
            padding-bottom: 120px;
        }

        .hero h1 {
            font-size: 70px;
            color: #0d7a3e;
            letter-spacing: 5px;
            text-shadow: 3px 3px 8px #7de3a8;
        }

        .hero p {
            font-size: 24px;
            color: #444;
            margin-top: 20px;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 15px;
            border: none;
            font-size: 20px;
            margin: 15px;
            transition: 0.3s;
        }

        .login-btn {
            background-color: #ff74b1;
            color: white;
        }

        .register-btn {
            background-color: #7be0b3;
            color: black;
        }

        .btn-custom:hover {
            transform: scale(1.08);
        }

        /* Featured books */
        .section-title {
            text-align: center;
            font-size: 50px;
            color: #06793f;
            margin-bottom: 50px;
            letter-spacing: 4px;
        }

        .book-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .book-card:hover {
            transform: translateY(-10px);
        }

        .book-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
        }

        .book-card h3 {
            margin-top: 15px;
            color: #0f7c42;
        }

        /* Why choose us */
        .feature-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: scale(1.05);
        }

        .feature-icon {
            font-size: 60px;
        }

        footer {
            text-align: center;
            margin-top: 80px;
            padding: 30px;
            background-color: #ffcde1;
            font-size: 18px;
        }

        .quote {
            text-align: center;
            font-size: 28px;
            margin-top: 80px;
            color: #444;
            font-style: italic;
        }
    </style>
</head>

<body>

    <!-- HERO -->
    <section class="hero">

        <div class="floating">
            <h1>🌸 BOOKSHOP 🌸</h1>
        </div>

        <p>
            Discover magical stories and your favourite books ✨
        </p>

        <div style="margin-top:40px;">

            <a href="{{ route('login') }}">
                <button class="btn-custom login-btn">
                    Login
                </button>
            </a>

            <a href="{{ route('register') }}">
                <button class="btn-custom register-btn">
                    Register
                </button>
            </a>

        </div>

    </section>

    <!-- QUOTE -->
    <div class="quote">
        “A reader lives a thousand lives before he dies.” 📚
    </div>

    <!-- FEATURED BOOKS -->
    <section class="container mt-5">

        <h2 class="section-title">
            Featured Books
        </h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/91MBi0bj6yL._SY425_.jpg">

                    <h3>Naruto</h3>

                    <p>
                        Full of friendship and action 
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/71oBjdOSkHL._SL1500_.jpg">

                    <h3>It</h3>

                    <p>
                        A terrifying story that turns childhood fears into reality
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="book-card">

                    <img src="https://m.media-amazon.com/images/I/A18Z68Ho+KL._SL1500_.jpg">

                    <h3>The Notebook</h3>

                    <p>
                        A touching love story that lasts through time
                    </p>

                </div>
            </div>

        </div>

    </section>

    <!-- WHY CHOOSE US -->
    <section class="container mt-5">

        <h2 class="section-title">
            Why Choose Us?
        </h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="feature-box">

                    <div class="feature-icon">
                        📚
                    </div>

                    <h3>Many Books</h3>

                    <p>
                        Various genres for every reader.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">

                    <div class="feature-icon">
                        🚚
                    </div>

                    <h3>Fast Purchase</h3>

                    <p>
                        Easy and quick buying process.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">

                    <div class="feature-icon">
                        💖
                    </div>

                    <h3>User Friendly</h3>

                    <p>
                        Smooth shopping experience for book lover.
                    </p>

                </div>
            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer>

        🌸 Thank you for visiting our Bookshop 🌸

        <br><br>

        © 2026 Bookshop. All Rights Reserved.

    </footer>

</body>

</html>