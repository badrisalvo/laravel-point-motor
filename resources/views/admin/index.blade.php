<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Videograph Template">
    <meta name="keywords" content="Videograph, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point Motor - Web Page</title>
    <link rel="icon" href="{{asset('assets/images/logo-icon.png')}}" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a class="text-white"><img src="{{asset('assets/images/logo-icon.png')}}" alt=""><h3> Point Motor </h3></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav__option">
                        <nav class="header__nav__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="/admin/home">Home</a></li>
                                <li><a href="/admin/kendaraan">Kendaraan</a></li>
                                <li><a href="/admin/service">Service</a></li>
                                <li><a href="/admin/reminder">Pengingat</a></li>
                                <li><a href="/admin/pelanggan">User Data</a></li>
                                @if(Auth::check() && Auth::user()->isAdmin())
                                <li><a href="#">Admin</a>
                                    <ul class="dropdown">
                                        <li><a href="/admin/kategori">Kategori</a></li>
                                        <li><a href="/admin/barang">Barang</a></li>
                                        <li><a href="/admin/laporan">Laporan</a></li>
                                    </ul>
                                </li>
                                @endif
                                <li><a href="#">Akun</a>
                                <ul class="dropdown">
                                    <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="icon-power mr-2"></i> Logout</button>
                                    </form>
                                    </ul>
                                </li>
                                
                                
                            </ul>
                        </nav>
                        <div class="header__nav__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    @foreach ($pelanggan as $index => $p)
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="/img/testimonial-bg.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <span id="nama_pelanggan-{{ $p->id }}">Selamat Datang, {{ $p->nama }}</span>
                                <h2>Point Motor Web page</h2>
                                <a href="/admin/kendaraan" class="primary-btn">Lihat Data Kendaraan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    @endforeach
    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="services__title">
                        <div class="section-title">
                            <span>Special Feature</span>
                            <h2>Point Motor</h2>
                        </div>
                        <p>Point Motor menyediakan Service Control yang mengingatkan anda secara berkala untuk melakukan checkup dan service kendaraan sesuai dengan kebutuhan anda</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                <img src="/img/icons/si-1.png" alt="">
                                </div>
                                <h4>Perbaikan Mesin</h4>
                                <p>Perbaikan mesin yang cepat dan efisien oleh teknisi berpengalaman kami.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                <img src="/img/icons/gear.png" alt="">
                                </div>
                                <h4>Tune-Up / Upgrade Mesin</h4>
                                <p>Tingkatkan performa Kendaraan anda di Point Motor untuk kebutuhan Khusus.<br>Diproses oleh mmekanik handal dalam dunia otomotif.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                <img src="/img/icons/motor.png" alt="">
                                </div>
                                <h4>Spare Part / Suku Cadang</h4>
                                <p>Dapatkan pergantian suku cadang yang berkualitas.<br>Tersedia juga untuk perbaikan Spare Part</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                <img src="/img/icons/si-4.png" alt="">
                                </div>
                                <h4>Repaint / Ganti Warna</h4>
                                <p>Repaint kendaraan anda agar tetap Stylish dan Aesthetic.<br> Point Motor telah menggunakan Kompressor Painting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top__logo">
                            <a class="text-white"><img src="{{asset('assets/images/logo-icon.png')}}" alt=""><h3>Point Motor</h3></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__option">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__option__item">
                            <h5 class="primary-btn">Tentang Kami</h5>
                            <p>Point Motor berdiri pada tahun 2018 dan berfokus pada pelayanan berkualitas tinggi untuk perawatan dan perbaikan motor Anda. 
                          <br>Kami memiliki teknisi berpengalaman dan menggunakan peralatan modern untuk memastikan setiap pekerjaan dilakukan dengan profesional.
                          <br>Beberapa Pelanggan Point Motor juga tergabung dalam Komunitas Racing tingkat Kota hingga Nasional.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="footer__option__item">
                            <h5 class="primary-btn">Alamat</h5>
                            <p>Parak Laweh Pulau Air Nan XX,<br>Gg. Pertemuan No.28, , Kec. Lubuk Begalung,<br> Kota Padang, Sumatera Barat 25223</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copyright">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p class="footer__copyright__text">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            Point Motor
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/masonry.pkgd.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>