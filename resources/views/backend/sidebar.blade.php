<body class="bg-theme bg-theme1">

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
      <div class="brand-logo">
        <a href="home">
          <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
          <h5 class="logo-text">Point Motor</h5>
        </a>
      </div>
      <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
          <a href="/admin/home">
            <i class="zmdi zmdi-view-dashboard"></i> <span>Home</span>
          </a>
        </li>

        @if(Auth::check() && Auth::user()->isAdmin())
        <li>
          <a href="/admin/kategori">
            <i class="zmdi zmdi-format-list-bulleted"></i> <span>Daftar Kategori</span>
          </a>
        </li>

        <li>
          <a href="/admin/barang">
            <i class="zmdi zmdi-grid"></i> <span>Data Barang</span>
          </a>
        </li>
        @endif
        <li>
          <a href="/admin/kendaraan">
            <i class="zmdi zmdi-car"></i> <span>Data Kendaraan</span>
          </a>
        </li>

        <li>
          <a href="/admin/service">
            <i class="zmdi zmdi-settings"></i> <span>Data Service</span>
          </a>
        </li> 
        <li>
          <a href="/admin/pelanggan">
            <i class="zmdi zmdi-face"></i> <span>Data User</span>
          </a>
        </li>
        <li>
          <a href="/admin/reminder">
            <i class="zmdi zmdi-calendar-check"></i> <span>Pengingat</span>
          </a>
        </li>
        @if(Auth::check() && Auth::user()->isAdmin())
        <li>
          <a href="/admin/laporan">
            <i class="zmdi zmdi-file"></i> <span>Laporan</span>
          </a>
        </li>
        @endif
      </ul>

    </div>

<header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-brand mx-auto d-flex align-items-center">
      <img src="{{asset('assets/images/logo-icon.png')}}" alt="logo" width="36" height="36" class="mr-2">
      <span>Point Motor Web Page</span>
    </div>
    <ul class="navbar-nav align-items-center right-nav-link">
      <li class="nav-item dropdown-lg">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
          href="javascript:void();">
          <i class="fa fa-envelope-open-o"></i></a>
      </li>
      <li class="nav-item dropdown-lg">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
          href="javascript:void();">
          <i class="fa fa-bell-o"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <i class="icon-user" alt="user avatar"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
            <a href="javaScript:void();">
              <div class="media-body">
                <h6 class="mt-2 user-title">{{ Auth::user()->nama }}</h6>
                <p class="user-subtitle">{{ Auth::user()->email }}</p>
              </div>
            </a>
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item"><i class="icon-power mr-2"></i> Logout</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</header>
<style>
.navbar-brand {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

.navbar-brand img {
  width: 36px;
  height: 36px;
  margin-right: 10px;
}

.navbar-brand span {
  display: inline-block;
}
</style>
