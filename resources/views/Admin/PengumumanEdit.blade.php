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
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title"
                                value="{{ old('title', $announcement->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar (jpg, jpeg, png)</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($announcement->gambar_url)
                                <div class="mt-3">
                                    <p>Gambar saat ini:</p>
                                    <img src="{{ asset('storage/foto/' . $announcement->gambar_url) }}"
                                        alt="Gambar lama" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        {{-- Upload PDF --}}
                        <div class="mb-3">
                            <label for="pdf_file" class="form-label">File PDF</label>
                            <input class="form-control @error('pdf_file') is-invalid @enderror" type="file"
                                id="pdf_file" name="pdf_file" accept="application/pdf">
                            @error('pdf_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($announcement->pdf_file)
                                <div class="mt-3">
                                    <p>File PDF saat ini: 
                                        <a href="{{ asset('storage/announcements/' . $announcement->pdf_file) }}" target="_blank">
                                            {{ $announcement->pdf_file }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-action p-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-danger">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
