@extends('layouts.Pengguna')

@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title bg-danger text-white py-5 shadow-sm" data-aos="fade">
        <div class="container text-center">
            <h1 class="fw-bold">Pengurus</h1>
            <p class="mt-2">Daftar pengurus yang berperan aktif dalam organisasi kami</p>
        </div>
        <nav class="breadcrumbs mt-3">
            <div class="container text-center">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white">Pengurus</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Trainers Section -->
    <section id="trainers" class="section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Tim Pengurus</h2>
                    <p class="text-muted">Berikut adalah para pengurus yang berdedikasi dalam membangun dan menjalankan kegiatan organisasi</p>
                </div>
            </div>

            <div class="row gy-5">
                @forelse ($coache as $item)
                <div class="col-lg-3 col-md-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100" style="max-width: 260px;">
                        <div class="card-img-top position-relative overflow-hidden rounded-4" style="height: 250px;">
                            <img src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                alt="Foto {{ $item->full_name }}" class="img-fluid object-fit-cover h-100 w-100 zoom-hover rounded-4">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mt-2 mb-1 fw-semibold">{{ $item->full_name }}</h5>
                            <p class="card-text text-muted mb-0">{{ $item->jabatan }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data pengurus yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</main>

<style>
    .zoom-hover {
        transition: transform 0.3s ease;
    }

    .zoom-hover:hover {
        transform: scale(1.05);
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
