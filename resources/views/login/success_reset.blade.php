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
            background: url("dist/img/BG.jpg");
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

        .loading-icon {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-5 my-5" style="border-radius: 20px;">
                    <div class="card-body p-4 p-sm-5 mt-5">
                        <div style="text-align: center">
                            <img src="{{ url('img/logo/success-logo.png') }}" width="70" height="70">
                            <h1 class="card-title text-center mt-5 fs-5" style="color: #2E308A;font-weight:600;">
                                Password Reset Successfully
                            </h1>
                            <p class="card-text text-center mb-2" style="font-size: 14px;">
                                Your password has been successfully reset. Please login with your new password
                            </p>
                        </div>
                        <div class="d-grid mt-5" style="margin-bottom: 150px;">
                            <a href="{{ route('login') }}" class="btn btn-login text-uppercase text-white" style="text-decoration: none; background-color: #32AF81; border-radius: 20px; font-size: 14px;font-weight:600;">
                                BACK TO LOGIN PAGE
                            </a>
                        </div>
                        <div class="mt-5 icon-bg">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src=" {{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function () {
                submitBtn.innerHTML = '<span class="loading-icon"><i class="fas fa-spinner fa-spin"></i></span>';
            });
        });
    </script>
</body>

</html>
