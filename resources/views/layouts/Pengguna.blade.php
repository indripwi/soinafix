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

    <!-- Vendor CSS Files -->
    <link href="{{ asset('Mentor/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Mentor/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('Mentor/assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{% static 'mentor/assets/css/main.css' %}">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    
          <a href="{{route('homepage')}}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('Mentor/assets/img/soina2.jpg') }}" width="250">
            <!-- <h1 class="sitename">SOINA</h1> -->
          </a>
    
          <nav id="navmenu" class="navmenu me-auto ms-4">
            <ul>
              <li><a href="{{route('homepage')}}" class="active">Home<br></a></li>
              <li><a href="{{route('tentang')}}">Tentang</a></li>
              <li><a href="{{route('program')}}">Program</a></li>
              <li><a href="{{route('pengurus')}}">Pengurus</a></li>
              <li><a href="{{route('prestasi')}}">Prestasi</a></li>
              <li><a href="{{route('pendaftaran')}}">Pendaftaran</a></li>
              <li><a href="{{route('pengumuman')}}">Pengumuman</a></li>
              
          </nav>
          <a href="{{route('login')}}" class="d-flex align-items-center me-3">
      <i class="bi bi-person-circle" style="font-size: 24px;"></i>
    </a>
        </div>
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
                <p>Jalan Yos Sudarso,</p>
                <p>Gg. 66 Rt, 32 Komplek Airmantan, Kota Banjarmasin</p>
                <p class="mt-3"><strong>Phone:</strong> <span>+62 xxxx xxxx</span></p>
                <p><strong>instagram:</strong><span>@soinabanjarmasin</span></p>
              </div>
              <div class="social-links d-flex mt-4">
                <a href="https://www.instagram.com/soinabanjarmasin?igsh=MTNmOHNlam5senc2Zg=="><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-youtube"></i></a>
              </div>
            </div>
    
            <div class="col-lg-2 col-md-3 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><a href="{{route('homepage')}}">Home</a></li>
                <li><a href="{{route('tentang')}}">Tentang</a></li>
                <li><a href="{{route('program')}}">Program</a></li>
                <li><a href="{{route('pengurus')}}">Pengurus</a></li>
                <li><a href="{{route('prestasi')}}">Prestasi</a></li>
                <li><a href="{{route('pendaftaran')}}">Pendaftaran</a></li>
                <li><a href="{{route('pengumuman')}}">Pengumuman</a></li>
              </ul>
            </div>
    
            <div class="col-lg-4 col-md-12 footer-newsletter">
              <h4>DONASI</h4>
             
            </div>
    
          </div>
        </div>
    
        <div class="container copyright text-center mt-4">
          <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span></p>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
          </div>
        </div>
    
      </footer>
    
      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
      <!-- Preloader -->
      <div id="preloader"></div>
    
      <!-- Vendor JS Files -->
      <script src="{{asset('Mentor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('Mentor/assets/vendor/php-email-form/validate.js')}}"></script>
      <script src="{{asset('Mentor/assets/vendor/aos/aos.js')}}"></script>
      <script src="{{asset('Mentor/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
      <script src="{{asset('Mentor/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
      <script src="{{asset('Mentor/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    
      <!-- Main JS File -->
      <script src="{{asset('Mentor/assets/js/main.js')}}"></script>
</body>

</html>
