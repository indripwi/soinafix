<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SOIna</title>
    <!-- Favicons -->
    <link href="{{ asset('Mentor/assets/img/soina.jpg') }}" rel="icon">
    <link href="{{ asset('Mentor/assets/img/soina.jpg') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Vendor CSS Files -->
    <link href="{{ asset('Mentor/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('Mentor/assets/css/main.css') }}" rel="stylesheet">
    

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
<style>
  .navbar-nav .nav-link.active {
    color: red !important;
    font-weight: bold;
    border-bottom: 2px solid red;
  }
</style>

</head>

<body class="index-page">

   <header class="header sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

      <a class="navbar-brand" href="{{ route('homepage') }}">
        <img src="{{ asset('Mentor/assets/img/soina2.jpg') }}" width="200" class="img-fluid" alt="Logo SOINA">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('program') ? 'active' : '' }}" href="{{ route('program') }}">Program</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('pengurus') ? 'active' : '' }}" href="{{ route('pengurus') }}">Pengurus</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('prestasi') ? 'active' : '' }}" href="{{ route('prestasi') }}">Prestasi</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('pengumuman') ? 'active' : '' }}" href="{{ route('pengumuman') }}">Pengumuman</a></li>
        </ul>

        <a href="{{ route('login') }}" class="d-flex align-items-center ms-3">
          <i class="bi bi-person-circle" style="font-size: 24px;"></i>
        </a>
      </div>
    </div>
  </nav>
</header>

    @yield('content')
    <footer id="footer" class="footer position-relative light-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">SOINA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p><i class="bi bi-geo-alt-fill me-2"></i>HKSN Permai Blok II A,</p>
                        <p><i class="bi bi-geo-alt me-2"></i>No.13 RT/RW 026/002 Alalak Utara Kota Banjarmasin, 70119
                        </p>
                        <p class="mt-3"><i class="bi bi-telephone-fill me-2"></i><strong>Phone:</strong> <span>‪+62
                                812 8740 0666‬</span></p>
                        <p><i class="bi bi-instagram me-2"></i><strong>Instagram:</strong>
                            <span>@soinabanjarmasin</span></p>
                        <p><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong>
                            <span>soinakotabanjarmasin@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="https://www.instagram.com/soinabanjarmasin?igsh=MTNmOHNlam5senc2Zg=="><i
                                class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang</a></li>
                        <li><a href="{{ route('program') }}">Program</a></li>
                        <li><a href="{{ route('pengurus') }}">Pengurus</a></li>
                        <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                        <li><a href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                        <li><a href="{{ route('pengumuman') }}">Pengumuman</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>DONASI</h4>
                    <p><strong>Dukung kami untuk terus mendampingi dan mengembangkan potensi atlet difabel!</strong></p>
                    <p>Scan QR Code berikut untuk berdonasi dengan mudah melalui aplikasi pembayaran digital Anda:</p>
                    <img src="{{ asset('Mentor/assets/img/barcode.jpg') }}" alt="QR Code Donasi SOINA"
                        style="width: 180px; height: auto; margin-top: 10px; border: 2px solid #ccc; border-radius: 8px;">
                    <p class="mt-3">Setiap donasi Anda sangat berarti bagi kami. Terima kasih atas dukungannya! ❤</p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                    href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
        
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('Mentor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Mentor/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('Mentor/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Mentor/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Mentor/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('Mentor/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('Mentor/assets/js/main.js') }}"></script>
   @guest
<!-- Popup dan script -->
<div id="loginPopup" style="...">...</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!localStorage.getItem('guestPopupShown')) {
            document.getElementById('loginPopup').style.display = 'flex';
            localStorage.setItem('guestPopupShown', 'true');
        }
    });
    function closePopup() {
        document.getElementById('loginPopup').style.display = 'none';
    }
</script>
@endguest

@auth
<script>
    localStorage.removeItem("guestPopupShown");
</script>
@endauth
</body>

</html>
