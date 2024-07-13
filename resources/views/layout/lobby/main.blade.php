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
            background-image: url("{{url()->asset('img/logo/bg-lobby.jpg')}}");
            min-height: auto;
            font-family: 'Source Sans Pro', sans-serif;
            background-size: 100%;
     
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
