<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Multitier Warehouse') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&amp;display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/v4-shims.min.css') }}">

  <!-- Google Tag Manager -->
  {{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WTQJTB4');</script> --}}
  <!-- End Google Tag Manager -->


  <!-- Styles -->
  <style>
    html {
      height: 100%;
      width: 100%;
      background: #FFFFFF;
      font-family: 'Source Sans Pro', sans-serif;
    }

    body {
      height: 100%;
      width: 100%;
      background: #FFFFFF;
      min-height: auto;
      font-family: 'Source Sans Pro', sans-serif;
    }

    .login-container {
      padding-right: 0px;
      padding-left: 0px;
      margin-right: 0px;
      margin-left: 0px;
      height: 100%;
      width: 100%;
      background: #FFFFFF;
    }

    .row-login {
      margin-right: 0px;
      margin-left: 0px;
      height: 100%;
      width: 100%;
      background: #FFFFFF;
    }

    .col-sm-0.col-bg {
      padding-right: 0px;
      padding-left: 0px;
      min-height: 5%;
      max-height: 100%;
    }

    .bg-layout {
      background:  #2E308A;
      height: 100%;
      min-height: 40px;
    }

    .icon-bg {
      background: url("{{ url('dist/img/puninarwhite.png') }} ") center / 184.47px 40px no-repeat;
      height: 100%;
      min-height: 40px;
    }

    .col-login {
      padding-right: 0px;
      padding-left: 0px;
      background: #FFFFFF;
    }

    .o-hidden.pt-xs-3.my-xs-3.login-wrapper {
      width: 60%;
      margin-left: 20%;

    }

    .login-wrapper {
      box-shadow: none !important;
    }

    .logo-wrapper {
      margin-bottom: 50px;

    }

    .logo-asmen {
      max-width: 100%;
    }

    .text-form {
      color: #2E308A;
      font-weight: bold;
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 600;
      font-size: 14px;
      line-height: 20px;
    }

    #email-1 {
      margin-top: 10px;
    }

    .text-form {
      color: #2E308A;
      font-weight: bold;
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 600;
      font-size: 14px;
      line-height: 20px;
    }

    .password-wrap {
      /*border-color: #fff;*/
      border: 1px solid #ced4da;
      border-radius: .25rem;
      /*border: 1px;*/
      /*outline: 0;*/
      /*box-shadow: 0 0 0 .25rem rgba(13,110,253,.25);*/
      margin-top: 10px;
    }

    .InputBorder {
      border-width: 0;

      border-radius: 0;
    }

    #eye_open {
      width: 16px;
      height: 16px;
    }

    #eye_close {
      width: 16px;
      height: 16px;
    }

    #login {
      background: #2E308A;
      font-weight: 600;
      letter-spacing: 1.2px;
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 600;
      font-size: 14px;
      line-height: 16px;
      height: 38px;
      border: 0px;
    }

    .change-password {
      color: #495057;
      text-decoration: inherit;
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 600;
      font-size: 12px;
      line-height: 20px;
    }

    #submitBtn-1 {
      background: #2E308A;
      letter-spacing: 1.2px;
      font-family: 'Inter';
      font-weight: 600;
      font-size: 14px;
      font-style: normal;
      line-height: 14px;
      height: 36px;
      border: 0px none rgb(255, 255, 255);
    }

    .col-rp {
      padding-right: 0px;
      padding-left: 0px;
      background: #FFFFFF;
    }

    .o-hidden.pt-xs-2.my-xs-2.card-rp {
      width: 80%;
      margin-left: 10%;
    }

    .text-back-wrap {
      margin-bottom: 20px;
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 600;
      font-size: 16px;
      line-height: 20px;
      display: flex;
      align-items: center;
    }

    .text-back {
      font-weight: 600;
      color: #2E308A;
    }

    svg {
      margin-right: 10px;
    }

    .text-wrapper {
      margin-bottom: 20px;
    }

    .heading-text {
      font-weight: 600;
      color: #2E308A;
    }

    .paragraph-text {
      color: #212529;
      font-weight: 400;
    }

    #emailForm-error {
      color: red;
      margin-bottom: 0px !important;
      margin-top: 8px !important;
    }
    .form-title{
      width: 214px;
height: 30px;

font-family: 'Source Sans Pro';
font-style: normal;
font-weight: 600;
font-size: 24px;
line-height: 30px;
display: flex;
align-items: center;

color: #2E308A;
    }
    .form-paragraf{
      font-family: 'Source Sans Pro';
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 18px;

color: #212529;
    }
    #errorMsg-1{
      font-family: 'Source Sans Pro';
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 20px;
    }
  </style>

</head>

<body class="overflow-hidden">
  <div class="container-fluid login-container">
    <div class="row g-0 row-login">
      <div class="col-sm-12 col-md-4 col-lg-6 col-xl-6 col-xxl-6 col-sm-0 col-bg">
        <div class="bg-layout">
          <div class="text-center icon-bg"></div>
        </div>
      </div>
      <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-6 ps-3 col-sm-12 col-login">
        <div class="card o-hidden border-0 my-md-4 pt-md-4 pt-sm-4 my-sm-4 my-xl-4 pt-xl-4 my-xxl-4 pt-xxl-4 px-5 mx-md-3 login-wrapper">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div>
                  <div><a href="{{url('login')}}"> <i class="fas fa-arrow-left mr-2" style="font-weight: 600;font-size: 16px;line-height: 20px;color: #2E308A;"></i>
                  <h3 style="font-family: 'Source Sans Pro';font-style: normal;font-weight: 400;font-size: 16px;display:contents;line-height: 20px;color: #32AF81;">  Back to Login</h3></a>
                </div>
                  <div class="px-5 pt-5 mx-3">
                  <h1 class="form-title">Check your mail!</h1>
                  <p class="form-paragraf">We have sent a password recover instructions to your email.</p>
                    <a href="{{url('login')}}" class="btn btn-primary text-capitalize btn-user mt-3 text-truncate" style="font-family: 'Source Sans Pro';font-style: normal;font-weight:400;font-size: font-size: 1.2vw;line-height: 16px;/* identical to box height, or 114% */text-align: center;letter-spacing: 1.25px;color: #FFFFFF;width: 50%;height: 36px;padding-top:8px !important;" id="forgotBtn"> BACK TO LOGIN PAGE</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src=" {{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>


  <script>
    $(document).ready(function() {

      // Reset Form:
      // $("#forgotPassword").validate({
      //   rules: {
      //     emailForm: {
      //       required: true,
      //       email: true
      //     }

      //   },
      //   messages: {
      //     email: "Please enter a valid email address"
      //   }

      // }); // end reset-form


    });

    function password_click() {
      var x = document.getElementById("password");
      var open = document.getElementById("eye_open");
      var close = document.getElementById("eye_close");
      if (x.type === "password") {
        x.type = "text";
        open.hidden = "true";
        close.hidden = "";
      } else {
        x.type = "password";
        open.hidden = "";
        close.hidden = "true";
      }
    }
  </script>
</body>

</html>
