<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PEVO Fieldman') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan link ke Font Awesome CSS (ganti dengan versi terbaru) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-....." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/css/bootstrap.min.css') }}">

    <style>
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 14px;
        }

        body, html {
            overflow: hidden;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            box-sizing: border-box;
            background: url("{{url()->asset('img/logo/bg-lobby.jpg')}}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .btn-login {
            letter-spacing: 0.2rem;
            padding: 0.75rem 1rem;
        }

        .icon-bg {
            background: url("{{ url('img/logo/logo.png') }} ") center no-repeat;
            height: 100%;
            min-height: 28px;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007BFF;
        }

        .toggle-confpassword {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007BFF;
        }

        .loading-icon {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
      

            
        </div>
    </div>
    <script src=" {{ asset('plugins/jquery/jquery.min.js') }}"></script>

</body>

</html>
