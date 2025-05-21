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
                    <form action="{{ route('olahraga.update', $program->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <div class="card-title">Edit Programs</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card-body">


                                        {{-- Nama Cabang Olahraga --}}
                                        <div class="mb-3">
                                            <label for="sport_name" class="form-label">Nama Cabang Olahraga</label>
                                            <input type="text"
                                                class="form-control @error('sport_name') is-invalid @enderror"
                                                id="sport_name" name="sport_name"
                                                value="{{ old('sport_name', $program->sport_name) }}" required>
                                            @error('sport_name')
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

                                            @if ($program->gambar_url)
                                                <div class="mt-3">
                                                    <p>Gambar saat ini:</p>
                                                    <img src="{{ asset('storage/foto/' . $program->gambar_url) }}"
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
                            <a href="{{ route('olahraga.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
