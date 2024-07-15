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
             <style>
                .modal-fullscreen .modal-dialog {
                  max-width: 100%;
                  margin: 0;
                }
                .modal-fullscreen .modal-content {
                  height: 100vh;
                  border: none;
                  border-radius: 0;
                }
                .modal-fullscreen .modal-body {
                  padding: 0;
                  height: calc(100% - 60px); /* Jika header dan footer tidak digunakan */
                }
                .modal-fullscreen .modal-header, .modal-fullscreen .modal-footer {
                  display: none; /* Sembunyikan header dan footer jika tidak digunakan */
                }
                .vh-100 {
                  background-color: #f4f5f7;
                }
                .gradient-custom {
                  /* fallback for old browsers */
                  background: #00dd76;
            
                  /* Chrome 10-25, Safari 5.1-6 */
                  background: -webkit-linear-gradient(to right bottom, rgb(16, 215, 149), rgba(253, 160, 133, 1));
            
                  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                  background: linear-gradient(to right bottom, rgb(3, 217, 213), rgba(253, 160, 133, 1));
                }
        
                .toggle-password img {
                    cursor: pointer;
                }
                .toggle-password-conf img {
                    cursor: pointer;
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
                        <a class="nav-link loglog text-right" id="profile" href="#" data-toggle="modal" data-target="#profileModal">
                            <span class="dropdown-item dropdown-header"> <strong>
                              <i class="fas fa-user-circle"></i> Profile
                               </strong></span></a> 
                      
                          <a class="nav-link loglog text-right" id="setting" href="{{route('option')}}">
                            <span class="dropdown-item dropdown-header"> <strong>
                              <i class="nav-icon fas fa-cog"></i> Option
                               </strong></span></a> 
                               
                          <a class="nav-link loglog" id="logout" href="#" onclick="logout()">
                                <span class="dropdown-item dropdown-header text-right"> <strong>
                                  <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                              </strong></span></a> 
                               <span class="dropdown-item dropdown-header"> <strong>
                           
                              </strong></span>
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
    @include('global.modal.profile')
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
