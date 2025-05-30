@extends('layouts.Pengguna')
@section('content')
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{asset('Mentor/assets/img/SOINA GENG.jpg')}}" alt="" data-aos="fade-in">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Special Olympics Indonesia<br>Cabang Kota Banjarmasin</h2>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="{{route('pendaftaran')}}" class="btn-get-started">BERGABUNG</a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{asset('Mentor/assets/img/atlet-1.jpg')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Tentang Special Olympics Indonesia</h3>
            <p class="fst-italic">
              Special Olympics Indonesia (SOIna) adalah organisasi nirlaba yang diakui Pemerintah dan telah mendapat akreditasi dari Special Olympics International (SOI) untuk menyelenggarakan pelatihan dan kompetisi olahraga, 
              serta inisiatif/program non-olahraga lainnya bagi Penyandang Disabilitas Intelektual (Persons with Intellectual Disabilities) atau Orang Bertalenta Khusus (OBK) di Indonesia.
            </p>
            <ul>
              
            </ul>
            <a href="{{route('tentang')}}" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Courses Section -->
    <section id="courses" class="courses section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>program</h2>
        <p>Program SOIna</p>
        
      </div><!-- End Section Title -->
     <div class="container">
    <div class="row">
      @foreach($programs as $item)
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="course-item">
          <img src="{{ asset('storage/foto/' . $item->gambar_url) }}" class="img-fluid" alt="">
          <div class="course-content">
            <h3>{{ $item->sport_name }}</h3>
            <p class="description">{{ Str::limit($item->deskripsi, 100) }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>

   <div class="text-center mt-4">
  <a href="{{ route('program') }}" class="btn rounded-pill text-white px-4 py-2 w-100" style="background-color: #e5391d;">
    Read More <span style="margin-left: 8px;">→</span>
  </a>
</div>

  </div>
</section> <!-- End Course Item-->

    </section><!-- /Courses Section -->
     <!-- Section Title -->
     <section id="trainers-index" class="section trainers-index">
     <div class="container section-title" data-aos="fade-up">
        <h2>pengurus</h2>
        <p>Pengurus SOIna</p>
        
      </div><!-- End Section Title -->
    <!-- Trainers Index Section -->
     <div class="container">
    <div class="row">
      @foreach($pengurus as $item)
      <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="member">
          <img src="{{ asset('storage/foto/' . $item->foto_url) }}" class="img-fluid" alt="">
          <div class="member-content">
            <h4>{{ $item->full_name }}</h4>
            <span>{{ $item->jabatan }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-4">
  <a href="{{ route('pengurus') }}" class="btn rounded-pill text-white px-4 py-2 w-100" style="background-color: #e5391d;">
    Read More <span style="margin-left: 8px;">→</span>
  </a>
</div>
  </div>
</section>

  </main>
@endsection