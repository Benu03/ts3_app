<style type="text/css" media="screen">
  .nav ul li p !important {
    font-size: 12px;
  }
  .infoku {
    margin-left: 20px; 
    text-transform: uppercase;
    color: yellow;
    font-size: 11px;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to bottom, #1d1c1c, #25872a); border-top-right-radius: 15px;">
  <!-- Brand Logo -->
    <!-- Brand Logo -->
    <a href="{{ asset('admin-cms/dasbor') }}" class="brand-link">
      <img src="{{ asset('assets/upload/image/'.website('icon')) }}"
         alt="{{ website('namaweb') }}"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
      <span class="brand-text font-weight-light">{{ website('nama_singkat') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- DASHBOARD -->
          <li class="nav-item">
            <a href="{{ asset('admin-cms/dasbor') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Berita &amp; Updates</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Berita &amp; Update<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/berita') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Berita &amp; Update</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/berita/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Berita/Update</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/kategori') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori berita</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Galeri &amp; Banner<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/galeri') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Galeri</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/galeri/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Galeri</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/kategori_galeri') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Galeri</p></a>
              </li>
            </ul>
          </li>

          

          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Event &amp; Agenda<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/agenda') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Event &amp; Agenda</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/agenda/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Event &amp; Agenda</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/kategori_agenda') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Event &amp; Agenda</p></a>
              </li>
            </ul>
          </li> --}}
          

          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-download"></i>
              <p>Download &amp; File<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/download') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data File</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/download/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah File</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/kategori_download') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori File</p></a>
              </li>
            </ul>
          </li> --}}

          {{-- <li class="nav-item">
            <a href="{{ asset('admin-cms/video') }}" class="nav-link">
              <i class="nav-icon fas fa-film"></i>
              <p>Video Webinar</p>
            </a>
          </li> --}}

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Profil &amp; Layanan</span></li>
          <li class="batas"><hr></li>

          <li class="nav-item">
            <a href="{{ asset('admin-cms/konfigurasi/profil') }}" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>Update Profil</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin-cms/berita/jenis_berita/Layanan') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Layanan</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Board &amp; Team<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/staff') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/staff/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/kategori_staff') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Board &amp; Team</p></a>
              </li>
            </ul>
          </li>

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Website Setting</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item">
            <a href="{{ asset('admin-cms/user') }}" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Pengguna Sistem</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin-cms/heading') }}" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Header Gambar</p>
            </a>
          </li>
          
          <!-- MENU -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin-cms/konfigurasi') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Konfigurasi Umum</p></a>
              </li>
            
              <li class="nav-item"><a href="{{ asset('admin-cms/konfigurasi/logo') }}" class="nav-link"><i class="fa fa-home nav-icon"></i><p>Ganti Logo</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/konfigurasi/icon') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Ganti Icon</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin-cms/konfigurasi/email') }}" class="nav-link"><i class="fa fa-envelope nav-icon"></i><p>Email Setting</p></a>
              </li>
              {{-- <li class="nav-item"><a href="{{ asset('admin-cms/rekening') }}" class="nav-link"><i class="fas fa-book nav-icon"></i><p>Rekening</p></a>
              </li> --}}
            </ul>
          </li>

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              <div class="col-md-12">
                 <h2 class="card-title"><?php echo $title ?></h2> 
              </div>
             
              
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
{{-- <div class="table-responsive konten"> --}}
