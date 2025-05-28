@extends('layouts.Pengguna')

@section('content')
<main class="main">
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Tentang SOINA</h1>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{route('homepage')}}">Home</a></li>
          <li class="current">Tentang SOINA</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- About Us Section -->
  <section id="about-us" class="section about-us">

    <div class="container">

      <div class="row gy-4">

        <!-- Gambar -->
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="{{asset('Mentor/assets/img/atlet-2.jpg')}}" class="img-fluid" alt="Tentang SOINA">
        </div>

        <!-- Teks Konten -->
        <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
          <h3>Tentang Special Olympics Indonesia</h3>
          <p>
            Special Olympics Indonesia (SOIna) adalah organisasi nirlaba yang diakui Pemerintah dan telah mendapat akreditasi dari Special Olympics International (SOI) untuk menyelenggarakan pelatihan dan kompetisi olahraga, serta inisiatif/program non-olahraga lainnya bagi Penyandang Disabilitas Intelektual (Persons with Intellectual Disabilities) atau Orang Bertalenta Khusus (OBK) di Indonesia.
          </p>

          <!-- Visi -->
          <div class="vision-mission">
            <h2>Visi</h2>
            <p class="fst-italic">
              Melalui gerakan Special Olympics, memberikan kesempatan kepada Penyandang Disabilitas Intelektual atau Orang Bertalenta Khusus (OBK) untuk menjadi warga negara yang berguna, produktif, diterima, dihargai, dan diakui kesetaraannya sebagai bagian dari masyarakat.
            </p>

            <!-- Misi -->
            <h2>Misi</h2>
            <p class="fst-italic">
              Menyelenggarakan pelatihan dan kompetisi olahraga olimpiade sepanjang tahun bagi Orang Bertalenta Khusus serta memberikan kesempatan yang berkesinambungan untuk membentuk fisik yang sehat, bugar, menunjukkan keberanian, merasakan kebahagiaan, serta dapat menunjukan kemampuan, keahlian, dan persahabatan, baik dengan keluarga, atlet Special Olympics lainnya, maupun masyarakat.
            </p>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /About Us Section -->

</main>
@endsection
