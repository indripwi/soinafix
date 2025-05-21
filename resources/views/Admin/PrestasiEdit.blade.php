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
                    <form action="{{ route('prestasi.update', $prestasi->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <div class="card-title">Edit Prestasis</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card-body">


                                        {{-- Nama Atlet --}}
                                        <div class="mb-3">
                                            <label for="nama_atlet" class="form-label">Nama Atlet</label>
                                            <input type="text"
                                                class="form-control @error('nama_atlet') is-invalid @enderror"
                                                id="nama_atlet" name="nama_atlet"
                                                value="{{ old('nama_atlet', $prestasi->nama_atlet) }}" required>
                                            @error('nama_atlet')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Cabang Olahraga --}}
                                        <div class="mb-3">
                                            <label for="cabang_olahraga" class="form-label">Cabang Olahraga</label>
                                            <input type="text"
                                                class="form-control @error('cabang_olahraga') is-invalid @enderror"
                                                id="cabang_olahraga" name="cabang_olahraga"
                                                value="{{ old('cabang_olahraga', $prestasi->cabang_olahraga) }}" required>
                                            @error('cabang_olahraga')
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

                                            @if ($prestasi->foto_url)
                                                <div class="mt-3">
                                                    <p>Gambar saat ini:</p>
                                                    <img src="{{ asset('storage/foto/' . $prestasi->foto_url) }}"
                                                        alt="Gambar lama" style="max-width: 200px;">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Deskripsi --}}
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input type="text"
                                                class="form-control @error('deskripsi') is-invalid @enderror"
                                                id="deskripsi" name="deskripsi"
                                                value="{{ old('deskripsi', $prestasi->deskripsi) }}" required>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('prestasi.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
