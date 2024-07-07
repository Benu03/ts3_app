<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/auth/fonts/icomoon/style.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/auth/css/owl.carousel.min.css') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}" />

    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/upload/image/'.website('icon')) }}">
    <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                  <a href="{{ '/' }}">
                    <img src="{{ asset('assets/auth/images/undraw_accept_tasks_re_09mv.svg')}}" alt="Image" class="img-fluid" />
                  </a>
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4 text-center">
                                <a href="{{ '/' }}">
                                    <img src="{{ asset('assets/upload/image/'.website('logo')) }}" alt="Image" class="img-fluid" width="200" height="200" />
                                    <!-- <p class="mb-4">Belife Apps Change Your Life Become Better</p> -->
                                </a>
                            </div>
                          
                            <form action="{{ asset('login/check') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                                <div class="form-group first">
                                    <label for="email">Username or Email</label>
                                    <input type="text" class="form-control" id="username" name="username"  required />
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required />
                                    <div class="input-group-append" style="position: absolute; right: 16px; top: 0; bottom: 0; display: flex; align-items: center;">
                                        <span class="input-group-text toggle-password" style="cursor: pointer; background-color: transparent; border: none; padding: 0;" onclick="togglePassword()">
                                            <i class="nav-icon material-symbols-rounded" style="font-size: 22px !important; color: #2E308A;">visibility_off</i>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex mb-2 align-items-center">
                                    <label class="control control--checkbox mb-0">


                                        <span class="caption">Remember Password</span>
                                        <input type="checkbox"   name="remember" id="remember"   />
                                        <div class="control__indicator"></div>

                               


                                    </label>
                                    <span class="ml-auto"><a href="javascript:void(0)" onclick="location.href='{{ 'login/lupa' }}'" class="forgot-pass">Forgot Password</a></span>
                                </div>
                                <button type="submit" class="btn btn-light btn-block"><i class="fas fa-sign-in-alt" style="color: #32af81;"></i> Sign In</button>
                                {{-- <input type="submit" value="Log In" class="btn btn-block btn-light" /> --}}


                                <span class="d-block text-left my-4 text-center text-white">Copyright &copy;<?= date('Y'); ?> {{ website('namaweb') }} Indonesia</span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card card-footer text-center">
            <strong class="text-center">
                Copyright &copy;<?= date('Y'); ?> PT TS3 Indonesia
            </strong>
    </div> -->
    <script src="{{ asset('assets/auth/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/auth/js/sweetalert2.min.js') }}"></script> --}}
    <script src="{{ asset('assets/auth/js/main.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <script>
        function showpassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
    @if ($message = Session::get('warning'))
    // Notifikasi
    swal ( "Mohon maaf" ,  "<?php echo $message ?>" ,  "warning" )
    @endif

    @if ($message = Session::get('sukses'))
    // Notifikasi
    swal ( "Berhasil" ,  "<?php echo $message ?>" ,  "success" )
    @endif


    const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const rememberCheckbox = document.getElementById('remember');

        // window.addEventListener('load', () => {
        //     const navbar = document.querySelector('.navbar');
        //     setTimeout(() => {
        //         navbar.classList.add('show');
        //     }, 200);
        // });

        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var icon = document.querySelector('.toggle-password i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.textContent = 'visibility';
            } else {
                passwordInput.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var navbar              = document.getElementById('navbar');
            var rememberCheckbox    = document.getElementById('remember');
            var usernameInput       = document.getElementById('username');
            var passwordInput       = document.getElementById('password');

            const loginBtn = document.getElementById('login-button');
            $('#login-button').click(function() {
                $('#login-text').hide();
                $('#login-spinner').show();
            });
        });
    </script>
</body>


</html>