@extends('layouts.Pengguna')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('Mentor/assets/img/SOINA GENG.jpg') }}" alt="" data-aos="fade-in">
        <div class="container text-center">
            <h2 data-aos="fade-up" data-aos-delay="100">Special Olympics Indonesia<br>Cabang Kota Banjarmasin</h2>
            <div class="d-flex justify-content-center mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('pendaftaran') }}" class="btn-get-started">BERGABUNG</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('Mentor/assets/img/atlet-1.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Tentang Special Olympics Indonesia</h3>
                    <p class="fst-italic">
                        Special Olympics Indonesia (SOIna) adalah organisasi nirlaba yang diakui Pemerintah dan telah mendapat akreditasi dari SOI untuk menyelenggarakan pelatihan dan kompetisi olahraga serta program lain bagi penyandang disabilitas intelektual di Indonesia.
                    </p>
                    <a href="{{ route('tentang') }}" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="courses" class="courses section">
        <div class="container section-title text-center" data-aos="fade-up">
            <h2>Program</h2>
            <p>Program SOIna</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach ($programs as $item)
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="program-img-wrapper">
                            <img src="{{ asset('storage/foto/' . $item->gambar_url) }}" alt="Program" class="img-fluid">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $item->sport_name }}</h5>
                            <p class="text-muted">{{ Str::limit($item->deskripsi, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('program') }}" class="btn rounded-pill text-white px-4 py-2"
                    style="background-color: #e5391d;">
                    Read More <span style="margin-left: 8px;">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Pengurus Section -->
    <section id="trainers-index" class="section trainers-index">
        <div class="container section-title text-center" data-aos="fade-up">
            <h2>Pengurus</h2>
            <p>Pengurus SOIna</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach ($coaches as $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm border-0 text-center">
                        <div class="pengurus-img-wrapper">
                            <img src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                alt="Pengurus" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->full_name }}</h5>
                            <p class="text-muted">{{ $item->jabatan }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pengurus') }}" class="btn rounded-pill text-white px-4 py-2"
                    style="background-color: #e5391d;">
                    Read More <span style="margin-left: 8px;">→</span>
                </a>
            </div>
        </div>
    </section>

</main>

<!-- CSS Khusus -->
<style>
    .program-img-wrapper,
    .pengurus-img-wrapper {
        width: 100%;
        height: 220px;
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
    }

    .program-img-wrapper img,
    .pengurus-img-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    @media (max-width: 767px) {
        .program-img-wrapper,
        .pengurus-img-wrapper {
            height: 180px;
        }
    }
</style>
@endsection
