@extends('layouts.Admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada kesalahan pada input Anda:<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('pengumuman.update', $announcement->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <div class="card-title">Edit Pengumuman</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card-body">


                                        {{-- Nama Atlet --}}
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Nama</label>
                                            <input type="text"
                                                class="form-control @error('full_name') is-invalid @enderror"
                                                id="title" name="title"
                                                value="{{ old('title', $announcement->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Jabatan --}}
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                id="description" name="description"
                                                value="{{ old('description', $announcement->description) }}" required>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Upload Gambar --}}
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar (jpg, png)</label>
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($announcement->foto_url)
                                                <div class="mt-3">
                                                    <p>Gambar saat ini:</p>
                                                    <img src="{{ asset('storage/foto/' . $announcement->foto_url) }}"
                                                        alt="Gambar lama" style="max-width: 200px;">
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
