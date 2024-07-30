@extends('auth.head')

@section('content')
<style>
        .containerz {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }
        .container img {
            margin-right: 10px; /* Sesuaikan jarak antara logo dan teks */
        }
        .text-center {
            text-align: center;
        }

</style>
<body class="bg-theme bg-theme1">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader --><br>
  <div class="containerz">
        <img src="/assets/images/logo-icon.png" alt="logo icon" style="height: 50px;"> <!-- Sesuaikan tinggi logo -->
        <h2>Point Motor Login Page</h2>
    </div>
  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="loader-wrapper">
      <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="card card-authentication1 mx-auto my-5">
      <div class="card-body">
        <div class="card-content p-2">
          <div class="text-center">
            <img src="/assets/images/logo-icon.png" alt="logo icon">
          </div>
          <div class="card-title text-uppercase text-center py-3">Login</div>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label for="email" class="sr-only">{{ __('Email') }}</label>
              <div class="position-relative has-icon-right">
                <input type="text" id="email" name="email" class="form-control input-shadow" placeholder="Email">
                <div class="form-control-position">
                  <i class="icon-user"></i>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">{{ __('Password') }}</label>
              <div class="position-relative has-icon-right">
                <input type="password" id="password" name="password"
                       class="form-control input-shadow @error('password') is-invalid @enderror"
                       placeholder="Password" required autocomplete="current-password">
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                  <i class="icon-eye" id="toggle-password" style="cursor: pointer;"></i>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
              </div>
              <div class="form-group col-6 text-right">
                <a href="reset-password.html">Reset Password</a>
              </div>
            </div>
            <button type="submit" class="btn btn-light btn-block">{{ __('Login') }}</button>
          </form>
        </div>
      </div>
      <div class="card-footer text-center py-3">
        <p class="text-white mb-0">Belum Punya Akun? <a class="text-danger mb-0" href="/register"> Daftar disini</a></p>
      </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm center">
    <marquee behavior="scroll" direction="left" style="margin: 0 auto; color: white;">
    Alamat  : Jln.Parak Laweh Pulau Air Nan XX, Gg. Pertemuan No.28, , Kec. Lubuk Begalung, Kota Padang, Sumatera Barat 25223
    </marquee>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const togglePassword = document.getElementById('toggle-password');
          const passwordInput = document.getElementById('password');

          if (togglePassword && passwordInput) {
              togglePassword.addEventListener('click', function () {
                  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                  passwordInput.setAttribute('type', type);
                  this.classList.toggle('icon-eye-off'); // Sesuaikan dengan kelas ikon mata tersembunyi yang Anda gunakan
              });
          }

          // Show success message using SweetAlert
          const successMessage = '{{ session('success') }}';
          if (successMessage) {
              Swal.fire({
                  title: 'Sukses',
                  text: successMessage,
                  icon: 'success'
              });
          }
      });
    </script>
    @include('auth.footer')
    @endsection
