<!DOCTYPE html>
<html>
<head>
    <title>NANApp Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#0b141a;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:400px;
            background:white;
            padding:40px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,.3);
        }

        .logo{
            text-align:center;
            color:#25D366;
            font-size:40px;
            font-weight:bold;
            margin-bottom:20px;
        }

        .btn-whatsapp{
            background:#25D366;
            color:white;
        }

        .btn-whatsapp:hover{
            background:#1fa855;
            color:white;
        }
    </style>
</head>
<body>

<div class="login-box">

    <div class="logo">
        NANApp
    </div>

    <h4 class="text-center mb-4">
        Sign In
    </h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <button class="btn btn-whatsapp w-100">
            Login
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('register') }}">
                Create Account
            </a>
        </div>

    </form>

</div>

</body>
</html>
