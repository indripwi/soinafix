@extends('layouts.Pengguna')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Program</h1>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="current">Program</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Courses Section -->
        <section id="courses" class="courses section">

            <div class="container">

                <div class="row">

                    @foreach ($program as $item)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="course-item">
                                <img class="img-fluid"
                                    src="{{ $item->gambar_url != null ? asset('storage/foto/' . $item->gambar_url) : asset('img/foto-tidak-ada.png') }}"
                                    alt="Card image cap" />
                                <div class="course-content">
                                    <h3>{{ $item->sport_name}}</h3>
                                    <p class="description">{{ $item->deskripsi}}</p>
                                </div>
                            </div>
                        </div> <!-- End Course Item-->
                    @endforeach

                </div>

            </div>

        </section><!-- /Courses Section -->

    </main>
@endsection
