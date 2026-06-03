<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VOXA Login</title>

    <link rel="icon" type="image/png" href="{{ asset('images/voxa-logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            font-family: 'Poppins', sans-serif;

        }

        body {

            min-height: 100vh;

            background:

                linear-gradient(135deg,
                    #1f2937,
                    #111827);

            display: flex;

            justify-content: center;

            align-items: center;

            overflow: hidden;

            position: relative;

        }

        /* background glow */

        body::before {

            content: '';

            position: absolute;

            width: 400px;

            height: 400px;

            background: #ff6b00;

            border-radius: 50%;

            top: -120px;

            right: -120px;

            opacity: .15;

            filter: blur(80px);

        }

        body::after {

            content: '';

            position: absolute;

            width: 350px;

            height: 350px;

            background: #ff9f43;

            border-radius: 50%;

            bottom: -120px;

            left: -120px;

            opacity: .12;

            filter: blur(80px);

        }

        .login-container {

            width: 100%;

            max-width: 430px;

            padding: 20px;

            z-index: 2;

        }

        .login-card {

            background: rgba(255, 255, 255, .08);

            backdrop-filter: blur(18px);

            border: 1px solid rgba(255, 255, 255, .12);

            border-radius: 28px;

            padding: 40px 30px;

            box-shadow:

                0 20px 60px rgba(0,
                    0,
                    0,
                    0.45);

        }

        .logo-area {

            text-align: center;

            margin-bottom: 30px;

        }


        .logo-area img {

            width: 110px;

            height: 110px;

            object-fit: contain;

            padding: 12px;

            border-radius: 50%;

            background:

                linear-gradient(145deg,
                    rgba(255, 255, 255, .15),
                    rgba(255, 255, 255, .05));

            border: 2px solid rgba(255,
                    255,
                    255,
                    .12);

            box-shadow:

                0 10px 35px rgba(255,
                    107,
                    0,
                    .35),

                inset 0 2px 10px rgba(255,
                    255,
                    255,
                    .08);

            backdrop-filter: blur(12px);

            transition: .4s ease;

        }


        .logo-area h1 {

            font-size: 40px;

            font-weight: 800;

            margin: 0;

            background: linear-gradient(45deg,
                    #ff6b00,
                    #ffb347);

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

            letter-spacing: 2px;

        }

        .logo-area p {

            color: #d1d5db;

            font-size: 14px;

            margin-top: 5px;

        }

        .login-title {

            color: white;

            text-align: center;

            font-size: 28px;

            font-weight: 600;

            margin-bottom: 30px;

        }

        .form-label {

            color: #f3f4f6;

            margin-bottom: 8px;

            font-size: 14px;

        }

        .form-control {

            height: 55px;

            border: none;

            border-radius: 14px;

            background: rgba(255, 255, 255, .12);

            color: white;

            padding-left: 45px;

            font-size: 15px;

        }

        .form-control:focus {

            background: rgba(255, 255, 255, .15);

            box-shadow:

                0 0 0 3px rgba(255,
                    107,
                    0,
                    .25);

            color: white;

        }

        .form-control::placeholder {

            color: #cbd5e1;

        }

        .input-group {

            position: relative;

        }

        .input-icon {

            position: absolute;

            top: 50%;

            left: 15px;

            transform: translateY(-50%);

            color: #ff9f43;

            z-index: 10;

            font-size: 18px;

        }

        .login-btn {

            width: 100%;

            height: 55px;

            border: none;

            border-radius: 14px;

            background: linear-gradient(45deg,
                    #ff6b00,
                    #ff9f43);

            color: white;

            font-size: 17px;

            font-weight: 600;

            transition: .3s ease;

            margin-top: 10px;

        }

        .login-btn:hover {

            transform: translateY(-2px);

            box-shadow:

                0 10px 25px rgba(255,
                    107,
                    0,
                    .35);

        }

        .bottom-link {

            text-align: center;

            margin-top: 25px;

        }

        .bottom-link a {

            color: #ffb347;

            text-decoration: none;

            font-weight: 500;

            transition: .3s;

        }

        .bottom-link a:hover {

            color: #fff;

        }

        .footer-text {

            text-align: center;

            margin-top: 25px;

            color: #9ca3af;

            font-size: 13px;

        }

        @media(max-width:576px) {

            .login-card {

                padding: 35px 22px;

                border-radius: 24px;

            }

            .logo-area h1 {

                font-size: 34px;

            }

        }

        .logo-area img:hover {

            transform: scale(1.05) rotate(3deg);

            box-shadow:

                0 15px 45px rgba(255,
                    107,
                    0,
                    .45);

        }
    </style>

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <!-- LOGO -->

            <div class="logo-area">

                <img src="{{ asset('images/voxa-logo.png') }}" alt="VOXA">

                <h1>VOXA</h1>

                <p>

                    Connect Instantly

                </p>

            </div>

            <!-- TITLE -->

            <h2 class="login-title">

                Welcome Back

            </h2>

            <!-- FORM -->

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->

                <div class="mb-4">

                    <label class="form-label">

                        Email Address

                    </label>

                    <div class="input-group">

                        <i class="bi bi-envelope-fill input-icon"></i>

                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            required>

                    </div>

                </div>

                <!-- PASSWORD -->

                <div class="mb-4">

                    <label class="form-label">

                        Password

                    </label>

                    <div class="input-group">

                        <i class="bi bi-lock-fill input-icon"></i>

                        <input type="password" name="password" class="form-control" placeholder="Enter your password"
                            required>

                    </div>

                </div>

                <!-- BUTTON -->

                <button type="submit" class="login-btn">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Login

                </button>

                <!-- REGISTER -->

                <div class="bottom-link">

                    <a href="{{ route('register') }}">

                        Create New Account

                    </a>

                </div>

                <!-- FOOTER -->

                <div class="footer-text">

                    VOXA © 2026 • Built by Sharon Sooraj

                </div>

            </form>

        </div>

    </div>

</body>

</html>
