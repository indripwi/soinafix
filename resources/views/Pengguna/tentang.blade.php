@extends('layouts.Pengguna')

@section('content')
<main class="main">

  <!-- Page Title -->
  <div class="page-title bg-danger text-white py-5 shadow-sm" data-aos="fade">
    <div class="container text-center">
      <h1 class="fw-bold">Tentang SOINA</h1>
      <p class="mt-2">Mengenal lebih dekat Special Olympics Indonesia</p>
    </div>
    <nav class="breadcrumbs mt-3">
      <div class="container text-center">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white">Home</a></li>
          <li class="breadcrumb-item active text-white">Tentang SOINA</li>
        </ol>
      </div>
    </nav>
  </div>

  <!-- About Us Section -->
  <section id="about-us" class="section about-us py-5 bg-light">
    <div class="container">
      <div class="row gy-5 align-items-center">

        <!-- Gambar -->
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src="{{ asset('Mentor/assets/img/atlet-2.jpg') }}" class="img-fluid rounded-4 shadow" alt="Tentang SOINA">
        </div>

        <!-- Teks Konten -->
        <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
          <h3 class="fw-bold mb-3">Tentang Special Olympics Indonesia</h3>
          <p class="mb-4">
            Special Olympics Indonesia (SOIna) adalah organisasi nirlaba yang diakui Pemerintah dan telah mendapat akreditasi dari Special Olympics International (SOI) untuk menyelenggarakan pelatihan dan kompetisi olahraga, serta inisiatif/program non-olahraga lainnya bagi Penyandang Disabilitas Intelektual (Persons with Intellectual Disabilities) atau Orang Bertalenta Khusus (OBK) di Indonesia.
          </p>

          <div class="vision-mission">
            <h4 class="fw-bold text-danger">Visi</h4>
            <p class="fst-italic mb-4">
              Melalui gerakan Special Olympics, memberikan kesempatan kepada Penyandang Disabilitas Intelektual atau Orang Bertalenta Khusus (OBK) untuk menjadi warga negara yang berguna, produktif, diterima, dihargai, dan diakui kesetaraannya sebagai bagian dari masyarakat.
            </p>

            <h4 class="fw-bold text-danger">Misi</h4>
            <p class="fst-italic">
              Menyelenggarakan pelatihan dan kompetisi olahraga olimpiade sepanjang tahun bagi Orang Bertalenta Khusus serta memberikan kesempatan yang berkesinambungan untuk membentuk fisik yang sehat, bugar, menunjukkan keberanian, merasakan kebahagiaan, serta dapat menunjukan kemampuan, keahlian, dan persahabatan, baik dengan keluarga, atlet Special Olympics lainnya, maupun masyarakat.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<style>
  .vision-mission h4 {
    margin-top: 1.5rem;
  }
</style>
@endsection
