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
            background: url("dist/img/BG.png");
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
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-5 my-5" style="border-radius: 20px;">
                    <div class="card-body p-4 p-sm-5">
                        <a href="{{ route('login_page') }}" style="text-decoration: none; color: #2E308A;font-size:16px;">
                            <h6 class="card-title text-left mb-5" style="color: #2E308A;font-weight:600;">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Login Page
                            </h6>
                        </a>
                        <form method="POST" action="{{ route('reset_password') }}">
                            @csrf
                            <div class="mb-2">
                                <h5 class="card-title text-left fs-5" style="color: #2E308A;font-weight:600;">
                                    New Password
                                </h5>
                            </div>
                            <div class="form-group mb-3 mt-3" style="font-size: 14px !important;">
                                <div>
                                    <label for="floatingPassword">New Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="floatingPassword" name="password" value="{{ old('password') }}">
                                    <span toggle="#floatingPassword" class="toggle-password" style="color: black;">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <div>
                                        <font color="red">
                                            {{ $errors->first('password') }}
                                        </font>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="confirmPassword">Confirm New Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="{{ old('confirmPassword') }}">
                                    <input type="hidden" name="email" id="email" value="{{ $data['username'] }}">
                                    <span toggle="#confirmPassword" class="toggle-confpassword" style="color: black;">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                                <div id="confirmPasswordError" style="color: red;"></div>
                            </div>
                            <div class="d-grid mt-5" style="margin-bottom: 150px;">
                                <button id="submitBtn" class="btn btn-login text-uppercase fw-bold text-white"
                                    style="background-color: #2E308A; border-radius: 20px; font-size: 14px;"
                                    type="submit">
                                    SUBMIT
                                    <span class="loading-icon d-none">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>

                            </div>
                            <div class="mt-5 icon-bg">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src=" {{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('floatingPassword');
            const togglePasswordBtn = document.querySelector('.toggle-password');

            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    togglePasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    togglePasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('confirmPassword');
            const togglePasswordBtn = document.querySelector('.toggle-confpassword');

            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    togglePasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    togglePasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });

         document.addEventListener('DOMContentLoaded', function () {
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function () {
                submitBtn.innerHTML = '<span class="loading-icon"><i class="fas fa-spinner fa-spin"></i></span>';
            });
        });

        $(document).ready(function () {
            $('#confirmPassword').on('input', function () {
                var passwordValue = $('#floatingPassword').val();
                var confirmPasswordValue = $(this).val();
                var confirmErrorDiv = $('#confirmPasswordError');

                if (passwordValue !== confirmPasswordValue) {
                    confirmErrorDiv.text('The new password does not match.');
                } else {
                    confirmErrorDiv.text('');
                }
            });
        });
    </script>
</body>

</html>
