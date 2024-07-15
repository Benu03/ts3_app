<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TS3 Indonesia') }}</title>
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
                    <div class="card-body p-4 p-sm-5">
                        <a href="{{ route('login') }}" style="text-decoration: none; color: #2E308A;font-size:16px;">
                            <h6 class="card-title text-left mb-5 fw-bold" style="color: #191B71;">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Login Page
                            </h6>
                        </a>
                        <form method="POST" action="{{ route('send-otp') }}">
                            @csrf
                            <div>
                                <h5 class="card-title text-left fw-bold fs-5" style="color: #191B71;">
                                    Enter OTP Code
                                </h5>
                                <p class="card-text text-justify mb-2">
                                    Please enter the OTP code that we have sent to your {{ $data['via'] }} to reset your password.
                                </p>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="floatingOtp">OTP Code</label>
                                </div>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="otp" name="otp" value="{{ old('otp') }}">
                                    <input type="hidden" name="username" id="username" value="{{ $data['username'] }}">
                                    <input type="hidden" name="otp_old" id="old_otp" value="{{ $data['otp'] }}">
                                </div>
                                <div id="validasiOtp" class="invalid-feedback" style="font-weight: 600;font-size:14px;">
                                </div>
                                @if ($errors->has('otp'))
                                    <div>
                                        <font color="red">
                                            {{ $errors->first('otp') }}
                                        </font>
                                    </div>
                                @endif
                            </div>
                            <div class="d-grid mt-5" style="margin-bottom: 150px;">
                                <button id="submitBtn" class="btn btn-login text-uppercase fw-bold text-white"
                                    style="background-color: #32AF81; border-radius: 20px; font-size: 14px;"
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
         document.addEventListener('DOMContentLoaded', function () {
            const submitBtn = document.getElementById('submitBtn');
            const otpInput = document.getElementById('otp');
            const oldOtpInput = document.getElementById('old_otp');

            submitBtn.addEventListener('click', function (e) {
                if (otpInput.value != '' && otpInput.value == oldOtpInput.value) {
                    submitBtn.innerHTML = '<span class="loading-icon"><i class="fas fa-spinner fa-spin"></i></span>';
                }else if (otpInput.value != oldOtpInput.value){
                    $('#validasiOtp').css('display', 'block');
                    $('#validasiOtp').text('Invalid OTP Code.');
                    $('#otp').focus();
                    e.preventDefault();
                }else if(otpInput.value == ''){
                    $('#validasiOtp').text('* Please fill your OTP Code');
                    $('#otp').focus();
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>
