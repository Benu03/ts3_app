<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $data['page_title'] }} - Main Page</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}">
    @include('layout.lobby.header')
    @stack('css')
    <style>
        body {
            height: 100%;
            width: 100%;
            background: #8b98bd;
            background-image: url("{{url()->asset('img/logo/bg-lobby.png')}}");
            min-height: auto;
            font-family: 'Source Sans Pro', sans-serif;
            background-size: 90%;
            background-repeat: repeat;
        }
        .card-link {
            text-decoration: none;
        }

        .card-link .card {
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
        }

        .card-link .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #d6d6f0; /* Warna latar belakang berubah saat hover */
        }

        .text-left.d-flex {
            display: flex;
            align-items: center;
        }

        .card-body {
            padding: 20px;
        }

        * {
          margin: 0;
          padding: 0;
        }
        
        #langit {
    position: absolute;
    top: 0;
    left: 0;
    width: 40%;
    z-index: -1;
}

.bulan {
    position: fixed;
    width: 30px;
    height: 30px;
    background: yellow;
    left: 70px;
    top: 95px;
    opacity: 0.1;
    border-radius: 50%;
    animation: bercahaya 3s linear infinite;
}

.awan {
    width: 200px;
    height: 60px;
    background: #9fd5e0;
    border-radius: 200px;
    position: relative;
    z-index: 9999;
}

.awan:before,
.awan:after {
    content: " ";
    position: absolute;
    background: #9fd5e0;
    width: 150px;
    height: 80px;
    top: -25px;
    left: 10px;
    border-radius: 100px;
}

.awan:after {
    width: 120px;
    height: 120px;
    top: -55px;
    right: 15px;
}

.no1 {
    top: 230px;
    animation: jalankanawan 15s linear infinite;
}

.no2 {
    left: 200px;
    transform: scale(0.6);
    opacity: 0.6;
    animation: jalankanawan 35s linear infinite;
}

.no3 {
    left: -250px;
    top: -250px;
    transform: scale(0.8);
    opacity: 0.8;
    animation: jalankanawan 13s linear infinite;
}

.no4 {
    left: 470px;
    top: -320px;
    transform: scale(0.75);
    opacity: 0.75;
    animation: jalankanawan 18s linear infinite;
}

.no5 {
    left: -150px;
    top: -150px;
    transform: scale(0.8);
    opacity: 0.8;
    animation: jalankanawan 20s linear infinite;
}

.no6 {
    top: 150px;
    left: 350px;
    transform: scale(0.7);
    opacity: 0.7;
    animation: jalankanawan 22s linear infinite;
}

.no7 {
    top: 170px;
    left: -50px;
    transform: scale(0.65);
    opacity: 0.65;
    animation: jalankanawan 11s linear infinite;
}

    
        @-webkit-keyframes jalankanawan {
          0% {
            margin-left: 1280px;
          }
          100% {
            margin-left: -1280px;
          }
        }
        @-moz-keyframes jalankanawan {
          0% {
            margin-left: 1280px;
          }
          100% {
            margin-left: -1280px;
          }
        }
        @-o-keyframes jalankanawan {
          0% {
            margin-left: 1280px;
          }
          100% {
            margin-left: -1280px;
          }
        }
  
        @-webkit-keyframes bercahaya {
          0% {
            opacity: 0.6;
            box-shadow: 3px 3px 35px 35px orange;
          }
          100% {
            opacity: 0.7;
            box-shadow: 3px 3px 40px 40px orange;
          }
        }
  
        @-moz-keyframes bercahaya {
          0% {
            opacity: 0.6;
            box-shadow: 3px 3px 35px 35px orange;
          }
          100% {
            opacity: 0.7;
            box-shadow: 3px 3px 40px 40px orange;
          }
        }
  
        @-o-keyframes bercahaya {
          0% {
            opacity: 0.6;
            box-shadow: 3px 3px 35px 35px orange;
          }
          100% {
            opacity: 0.7;
            box-shadow: 3px 3px 40px 40px orange;
          }
        }
  

      </style>

</head>

<body class="vsc-initialized sidebar-collapse">
   
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm"
            style="border-radius:0px !important;">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="" href="{{route('lobby')}}" role="button">
                        <i class="fa fa-computer"></i>
                    </a>
                </li>
              
                <li class="nav-item dropdown">
                    <a class="nav-link" id="role_name" data-toggle="dropdown" href="#">
                        {{ Session::get('user')['full_name'] }}
                        <span class="fas fa-chevron-down" style="padding-left:5px;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a class="nav-link loglog text-right" id="profile" href="#">
                         <span class="dropdown-item dropdown-header"> Hello <strong>
                           {{ Session::get('user')['full_name'] }}
                            </strong></span></a> 
                        <div class="dropdown-divider"></div>
                        <a class="nav-link loglog text-right" id="logout" href="#" onclick="logout()">
                            <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

    
    @yield('content')
    
    <!-- /.content-wrapper -->
    @include('global.modal.wrapper',['id_modal'=>'modal-notif','modal_content'=>'modal-notif-content'])
    @include('layout.lobby.footer')
    @stack('js')
    <script>
        function logout(){
            Swal.fire({
                title: 'Are you sure to log out?',
                type: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#30347a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value === true) {
                    $('#logout-form').submit()
                }
            })
        }
    </script>
</body>

</html>
