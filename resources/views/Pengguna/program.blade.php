@extends('layouts.Pengguna')

@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title bg-danger text-white py-5 shadow-sm" data-aos="fade">
        <div class="container text-center">
            <h1 class="fw-bold">Program</h1>
            <p class="mt-2">Beragam program olahraga yang kami selenggarakan</p>
        </div>
        <nav class="breadcrumbs mt-3">
            <div class="container text-center">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white">Program</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Courses Section -->
    <section id="courses" class="courses section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Daftar Program</h2>
                    <p class="text-muted">Pilih program yang sesuai dengan minat dan bakat Anda</p>
                </div>
            </div>

            <div class="custom-grid">
                @foreach ($program as $item)
                <div class="program-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="image-wrapper bg-white">
                            <img src="{{ $item->gambar_url ? asset('storage/foto/' . $item->gambar_url) : asset('img/foto-tidak-ada.png') }}"
                                 alt="Gambar Program {{ $item->sport_name }}"
                                 class="img-fluid object-fit-contain h-100 w-100">
                        </div>
                        <div class="card-body text-center py-3">
                            <h6 class="card-title fw-semibold mb-0">{{ $item->sport_name }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</main>

<style>
    .custom-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        justify-items: center;
    }

    @media (min-width: 1200px) {
        .custom-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .program-card {
        width: 100%;
        transition: transform 0.3s ease;
    }

    .program-card:hover {
        transform: scale(1.03);
    }

    .image-wrapper {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .object-fit-contain {
        object-fit: contain;
    }
</style>
@endsection
