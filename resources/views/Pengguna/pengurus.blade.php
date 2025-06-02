@extends('layouts.Pengguna')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Pengurus</h1>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="current">Pengurus</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Trainers Section -->
        <section id="trainers" class="section trainers">
            <div class="container">
                <div class="row gy-5">
                    @foreach ($coache as $item)
                        <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                <img src="{{ $item->foto_url != null ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                    alt="" class="zoom-hover">
                            </div>
                            <div class="member-info text-center">
                                <h4>{{ $item->full_name }}</h4>
                                <span>{{ $item->jabatan }}</span>
                                <p></p>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach
                </div><!-- End Team Member -->
            </div>
            </div>
        </section><!-- /Trainers Section -->

    </main>
@endsection
