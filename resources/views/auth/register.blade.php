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
    <!-- end loader -->
     <br>
    <div class="containerz">
        <img src="/assets/images/logo-icon.png" alt="logo icon" style="height: 50px;"> <!-- Sesuaikan tinggi logo -->
        <h2>Point Motor Registration Page</h2>
    </div>
    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo icon">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Daftar</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="sr-only">Nama</label>
                            <div class="position-relative has-icon-right">
                                <input id="nama" type="text"
                                    class="form-control input-shadow @error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama') }}" required autocomplete="nama" autofocus
                                    placeholder="Masukkan Nama Anda">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Alamat Email</label>
                            <div class="position-relative has-icon-right">
                                <input id="email" type="email"
                                    class="form-control input-shadow @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Masukkan Alamat Email">
                                <div class="form-control-position">
                                    <i class="icon-envelope-open"></i>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Kata Sandi</label>
                            <div class="position-relative has-icon-right">
                                <input id="password" type="password"
                                    class="form-control input-shadow @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Password">
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
                        <div class="form-group">
                            <label for="password-confirm" class="sr-only">Konfirmasi Kata Sandi</label>
                            <div class="position-relative has-icon-right">
                                <input id="password-confirm" type="password" class="form-control input-shadow"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                    <i class="icon-eye" id="toggle-password-confirm" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="sr-only">Nomor Telepon</label>
                            <div class="position-relative has-icon-right">
                                <input id="no_hp" type="text" class="form-control input-shadow @error('no_hp') is-invalid @enderror" name="no_hp"
                                    value="{{ old('no_hp', '+62') }}" required autocomplete="no_hp"
                                    placeholder="Masukkan Nomor Telepon Anda dengan +62">
                                <div class="form-control-position">
                                    <i class="icon-phone"></i>
                                </div>
                                @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="sr-only">Alamat</label>
                            <textarea id="alamat"
                                class="form-control input-shadow @error('alamat') is-invalid @enderror" name="alamat"
                                required autocomplete="alamat"
                                placeholder="Masukkan Alamat Anda">{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="role" value="customer">
                        <button type="submit" class="btn btn-light btn-block waves-effect waves-light">Daftar</button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">Sudah punya akun? <a href="{{ route('login') }}"> Masuk di sini</a></p>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm center">
    <marquee behavior="scroll" direction="left" style="margin: 0 auto; color: white;">
    Alamat  : Jln.Parak Laweh Pulau Air Nan XX, Gg. Pertemuan No.28, , Kec. Lubuk Begalung, Kota Padang, Sumatera Barat 25223
    </marquee>
    </nav>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle password visibility
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('icon-eye-off');
        });

        const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
        const passwordConfirmInput = document.getElementById('password-confirm');

        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmInput.setAttribute('type', type);
            this.classList.toggle('icon-eye-off');
        });

        // Ensure phone number always starts with +62
        const phoneNumberInput = document.getElementById('no_hp');

        if (!phoneNumberInput.value.startsWith('+62')) {
            phoneNumberInput.value = '+62';
        }

        phoneNumberInput.addEventListener('input', function () {
            const value = phoneNumberInput.value;

            if (!value.startsWith('+62')) {
                phoneNumberInput.value = '+62';
            }

            const prefix = '+62';
            if (value.length > prefix.length && value[prefix.length] === '0') {
                phoneNumberInput.value = prefix + value.slice(prefix.length + 1);
            }
        });
    });
</script>

        @include('auth.footer')
        @endsection