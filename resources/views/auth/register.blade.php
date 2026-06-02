<!DOCTYPE html>
<html>
<head>
    <title>NANApp Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#0b141a;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .register-box{
            width:100%;
            max-width:450px;
            background:white;
            border-radius:15px;
            padding:40px;
            box-shadow:0 15px 35px rgba(0,0,0,.3);
        }

        .logo{
            text-align:center;
            color:#25D366;
            font-size:40px;
            font-weight:bold;
            margin-bottom:10px;
        }

        .subtitle{
            text-align:center;
            color:#666;
            margin-bottom:25px;
        }

        .btn-whatsapp{
            background:#25D366;
            color:white;
            border:none;
        }

        .btn-whatsapp:hover{
            background:#20b95a;
            color:white;
        }

        .form-control{
            height:50px;
        }
    </style>
</head>
<body>

<div class="register-box">

    <div class="logo">
        NANApp
    </div>

    <div class="subtitle">
        Create your account
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit"
                class="btn btn-whatsapp w-100 py-2">
            Create Account
        </button>

        <div class="text-center mt-3">
            Already have an account?
            <a href="{{ route('login') }}">
                Login
            </a>
        </div>

    </form>

</div>

</body>
</html>
