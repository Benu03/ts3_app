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
            font-family: 'Source Sans Pro', sans-serif;
            background-size: 100%;
            background-repeat: no-repeat;
            transition: background-image 0.8s ease-in-out;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(167, 165, 165, 0.225); 
            z-index: -1;
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
          background: #f6d365;
    
          /* Chrome 10-25, Safari 5.1-6 */
          background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
    
          /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        }

        .toggle-password img {
            cursor: pointer;
        }
        .toggle-password-conf img {
            cursor: pointer;
        }
 
        .custom-navbar {
            background-color: rgba(255, 255, 255, 0); /* Warna putih dengan transparansi 50% */
        }
        .notification-scroll {
            max-height: 400px; /* Ubah sesuai kebutuhan */
            overflow-y: auto;
        }
        .text-custom-secondary {
            color: #6c757d; /* Warna abu-abu default Bootstrap */
            opacity: 0.5;   /* Tambahkan opacity jika perlu */
            font-style: italic; /* Contoh, bisa diubah sesuai preferensi */
        }

        .same-size-button {
            padding: 10px 20px; /* Mengatur padding agar tombol memiliki ukuran yang sama */
            font-size: 16px; /* Mengatur ukuran font */
            width: 100px; /* Mengatur lebar tombol sama */
        }
        </style>

</head>

<body class="vsc-initialized sidebar-collapse">
   
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light rounded-5  fixed-top custom-navbar"
            style="border-radius:0px !important;">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="" href="{{route('notif')}}" role="button">
                      <i class="fas fa-bell"></i>
                    </a>
                </li> --}}
                <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" id="notification-dropdown">
                      <i class="fas fa-bell"></i>
                      <span class="badge badge-warning navbar-badge" id="notification-count"><strong>0</strong></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-4">
                      <span class="dropdown-header" id="notification-header">No Notifications</span>
                      <div class="dropdown-divider"></div>
                      <div id="notification-list" class="notification-scroll"></div>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                  </div>
                </li>
                
              
              
                <li class="nav-item dropdown">
                    <a class="nav-link" id="role_name" data-toggle="dropdown" href="#">
                      <strong>{{ Session::get('user')['full_name'] }}</strong>
                        <span class="fas fa-chevron-down" style="padding-left:5px;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-5">
                            
                            <a class="nav-link loglog text-right" id="profile" href="#" data-toggle="modal" data-target="#profileModal">
                              <span class="dropdown-item dropdown-header"> <strong>
                                <i class="fas fa-user-circle"></i> Profile
                                 </strong></span></a> 
                        
                      

                                 <a class="nav-link loglog text-right" id="changepassword" href="#" data-toggle="modal" data-target="#changePassword">
                                  <span class="dropdown-item dropdown-header"> <strong>
                                    <i class="nav-icon fas fa-key"></i> Change Password
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
    <!-- Modal HTML -->

    <!-- /.content-wrapper -->
    @include('global.modal.wrapper',['id_modal'=>'modal-notif','modal_content'=>'modal-notif-content'])
    @include('global.modal.profile')
  
    @include('global.modal.changepassword')
    @include('global.modal.notif')
    @include('layout.lobby.footer')
  
    @stack('js')
    
  
    <script src=" {{ asset('plugins/jquery/jquery.min.js') }}"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan modal secara dinamis
        var modalHtml = `
            <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5> 
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="notification-modal-body">
                            <!-- Notifikasi detail akan ditampilkan di sini -->
                        </div>
                       
                    </div>
                </div>
            </div>
        `;

        // Menyisipkan modal ke dalam body HTML
        document.body.insertAdjacentHTML('beforeend', modalHtml);

        function fetchNotifications() {
            fetch("{{ route('getnotif') }}")
                .then(response => response.json())
                .then(notifications => {
                    console.log(notifications); 
                    var notificationList = document.getElementById('notification-list');

                    var unreadNotifications = notifications.filter(function(notification) {
                        return notification.is_read === null;
                    });

                    var notificationCount = unreadNotifications.length;

                    document.getElementById('notification-count').innerText = notificationCount;
                    

                    document.getElementById('notification-header').innerHTML = '<strong>' + notificationCount + '</strong> Notifications';

                    notificationList.innerHTML = '';

                    if (notificationCount > 0) {
                        notifications.forEach(function(notification) {
                            var timeAgo = calculateTimeAgo(notification.created_date);
                            var categoryClass = "";
                            var categoryIcon = "";
                            var readClass = "";

                            if (notification.category_name === 'info') {
                                categoryClass = "text-info";
                                categoryIcon = "fas fa-info-circle";
                            } else if (notification.category_name === 'general') {
                                categoryClass = "text-success";
                                categoryIcon = "fas fa-globe-asia";
                            }

                            if (notification.is_read === true) {
                              readClass = "text-custom-secondary";
                            } else {
                                readClass = "text-dark fw-bold"; 
                            }
                                            
                            var item = `
                                <a href="#" class="dropdown-item ${readClass}" data-notif-id="${notification.id}">
                                    <i class="${categoryIcon} ${categoryClass} me-2"></i>
                                    <span><strong>${notification.module}</strong></span> 
                                    <span class="float-end text-muted text-sm">${timeAgo}</span><br>
                                    <small>${notification.title}</small>
                                </a>
                                <div class="dropdown-divider"></div>
                            `;
                            notificationList.insertAdjacentHTML('beforeend', item);
                        });

                        document.querySelectorAll('.dropdown-item').forEach(item => {
                            item.addEventListener('click', function(e) {
                                e.preventDefault();

                                var notifId = this.getAttribute('data-notif-id');
                                var clickedNotification = notifications.find(function(n) {
                                    return n.id == notifId;
                                });
                                      if (clickedNotification) {
                                        document.getElementById('notification-modal-body').innerHTML = `
                                        <div class="card border-light shadow-sm">
                                           <span class="badge text-white" style="background-color: #6dcbd3; font-size: 1.2rem;">${clickedNotification.module}</span>
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                                    <span><strong>${clickedNotification.title}</strong></span>
                                                   
                                                </h5>
                                                <hr> <hr>
                                                <div class="mb-3">
                                                    <h6><i class="fas fa-info-circle"></i> <strong>Message</strong></h6>
                                                    <p class="text-muted">${clickedNotification.detail}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6><i class="fas fa-file-alt"></i> <strong>Content</strong></h6>
                                                    <p class="text-muted">${clickedNotification.data_content}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6><i class="fas fa-clock"></i> <strong>Created</strong></h6>
                                                    <p class="text-muted">${new Date(clickedNotification.created_date).toLocaleString()}</p>
                                                </div>
                                            </div>
                                        </div>
                                    `;


                                              
                                                var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                                                notificationModal.show();


                                                fetch("{{ route('updatenotif') }}", {
                                                  method: 'POST',
                                                  headers: {
                                                      'Content-Type': 'application/json',
                                                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                  },
                                                  body: JSON.stringify({ notif_id: notifId })
                                              })
                                              .then(response => response.json())
                                              .then(data => {
                                                  if (data.success) {
                                                      console.log('Status notifikasi berhasil diperbarui');
                                                  } else {
                                                      console.error('Gagal memperbarui notifikasi');
                                                  }
                                              })
                                              .catch(error => console.error('Gagal memperbarui notifikasi', error));
                                            } else {
                                                  console.error('Notifikasi tidak ditemukan');
                                              }
                            });
                        });
                    } else {
                        notificationList.insertAdjacentHTML('beforeend', '<a href="#" class="dropdown-item text-center">No notifications</a>');
                    }
                })
                .catch(error => {
                    console.error('Gagal memuat notifikasi', error);
                    document.getElementById('notification-list').insertAdjacentHTML('beforeend', '<a href="#" class="dropdown-item text-center">Failed to load notifications</a>');
                });
        }


        fetchNotifications();


        document.getElementById('notification-dropdown').addEventListener('click', function() {
            fetchNotifications();
        });

        setInterval(fetchNotifications, 300000); 

        function calculateTimeAgo(timestamp) {
            var date = new Date(timestamp.replace(' ', 'T')); 
            var now = new Date();
            var diff = Math.floor((now - date) / 1000); 

            if (diff < 60) return diff + " secs ago";
            if (diff < 3600) return Math.floor(diff / 60) + " mins ago";
            if (diff < 86400) return Math.floor(diff / 3600) + " hours ago";
            return Math.floor(diff / 86400) + " days ago";
        }
    });
</script>

  
  

   <script>
    // Daftar URL background
      const backgrounds = [
        "{{url()->asset('img/logo/1.jpg')}}",
          "{{url()->asset('img/logo/2.jpg')}}",
          "{{url()->asset('img/logo/3.jpg')}}"
      ];

      let currentIndex = 0;

      function changeBackground() {
          document.body.style.backgroundImage = `url('${backgrounds[currentIndex]}')`;
          currentIndex = (currentIndex + 1) % backgrounds.length;
      }


      setInterval(changeBackground, 5000);

      // Set background pertama kali
      changeBackground();
   </script>

    <script>
        function logout(){
            Swal.fire({
                title: 'Are you sure to log out?',
                type: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#6eb1c4',
                cancelButtonColor: '#d33',
                confirmButtonText: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',  
                cancelButtonText: '&nbsp;&nbsp;&nbsp;Tidak&nbsp;&nbsp;&nbsp;',
                customClass: {
                        popup: 'rounded-modal',
                    }
            }).then((result) => {
                if (result.value === true) {
                    $('#logout-form').submit()
                }
            })
        }


            function togglePassword(input, nameClass) {
                var passwordInput       = document.getElementById(`${input}`);
                var eyeIcon             = document.getElementById("eyeIcon");
                const togglePasswordBtn = document.querySelector(`.${nameClass}`);
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    togglePasswordBtn.innerHTML = `<img src="{{ config('static.url_portal_ts3_main') }}img/logo/eye-close.png">`;
                } else {
                    togglePasswordBtn.innerHTML = `<img src="{{ config('static.url_portal_ts3_main') }}img/logo/eye-open.png" style="margin-bottom:3px;">`;
                }

            }

    </script>

    <script>
      $('#updatePasswordBtn').on('click', function(e) {
        e.preventDefault();

        // Tampilkan SweetAlert2 loading
        const swalLoading = Swal.fire({
          title: 'Processing...',
          text: 'Please wait a moment.',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        let username = $('#username').val();
        let oldpwd = $('#old_password').val();
        let password = $('#password').val();
        let confPwd = $('#confirm_password').val();
        let isValid = true;

        // Validasi input
        if (!oldpwd) {
          $('#validationOldPassword').html('*Old Password is required');
          isValid = false;
        } else {
          $('#validationOldPassword').html('');
        }

        if (!password) {
          $('#validationPassword').html('*Password is required');
          isValid = false;
        } else {
          $('#validationPassword').html('');
        }

        if (!confPwd) {
          $('#validationConfPassword').html('*Confirmation Password is required');
          isValid = false;
        } else if (confPwd !== password) {
          $('#validationConfPassword').html('*Confirmation Password does not match');
          isValid = false;
        } else {
          $('#validationConfPassword').html('');
        }

        if (!isValid) {
          Swal.close(); // Menutup loading jika ada kesalahan validasi
          return false;
        }

        // Kirim data dengan AJAX jika semua validasi lulus
        $.ajax({
          type: "POST",
          url: "{{ route('change_password') }}",
          data: {
            username: username,
            oldpwd: oldpwd,
            password: password,
            _token: "{{ csrf_token() }}"
          },
          success: function(response) {
            Swal.close(); // Menutup loading

            Swal.fire({
              icon: 'success',
              title: 'Success',
            //   text: response.message,
              timer: 3000,
              showConfirmButton: false
            });

                    
                // Bersihkan form input

                $('#old_password').val('');
                $('#password').val('');
                $('#confirm_password').val('');
              
                $('#changePassword').removeClass('show').addClass('fade');
                $('body').removeClass('modal-open');


                $('.modal-backdrop').remove();


        
          },
          error: function(xhr) {
            Swal.close(); // Menutup loading
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: xhr.responseJSON.message || 'Something went wrong!',
              timer: 3000,
              showConfirmButton: false
            });
          }
        });
      });
    </script>

  

      
</body>

</html>
