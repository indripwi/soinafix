@extends('layouts.Pengguna')

@section('content')
<main class="main">

  <!-- Page Title -->
  <div class="page-title bg-danger text-white py-5 shadow-sm" data-aos="fade">
    <div class="container text-center">
      <h1 class="fw-bold">Prestasi</h1>
      <p class="mt-2">Kebanggaan atlet Special Olympics Indonesia</p>
    </div>
    <nav class="breadcrumbs mt-3">
      <div class="container text-center">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white">Home</a></li>
          <li class="breadcrumb-item active text-white">Prestasi</li>
        </ol>
      </div>
    </nav>
  </div>

  <!-- Prestasi Section -->
  <section id="prestasi" class="section py-5 bg-light">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4">
        @foreach ($prestasi as $item)
        <div class="col-12 col-sm-6 col-lg-4 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 w-100">
            <div class="image-wrapper-small rounded-top">
              <img src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}" alt="Prestasi Atlet" class="img-fluid">
            </div>
            <div class="card-body text-center">
              <h5 class="card-title fw-bold mb-1">{{ $item->nama_atlet }}</h5>
              <p class="text-danger fw-semibold mb-2">{{ $item->cabang_olahraga }}</p>
              <p class="card-text small">{{ $item->deskripsi }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

</main>

<style>
  .image-wrapper-small {
    width: 100%;
    height: 180px;
    background-color: #f8f9fa;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .image-wrapper-small img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .card:hover img {
    transform: scale(1.03);
  }

  .card {
    transition: transform 0.3s ease;
    border-radius: 0.5rem;
  }

  .card:hover {
    transform: translateY(-4px);
  }
</style>
@endsection
