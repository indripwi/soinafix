@extends('layouts.Admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Profil Admin</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabel Daftar Admin --}}
        <div class="card mb-5">
            <div class="card-header bg-primary text-white">Daftar Admin</div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $loginUser = auth()->user();
                                $biodata = $loginUser->biodata;
                            @endphp
                            <tr>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $loginUser->email }}</td>
                                <td>{{ $user->telepon }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>
                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" width="80" class="rounded">
                                    @else
                                        <em>-</em>
                                    @endif
                                </td>
                                <td>

                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Form Edit Profil --}}
        <div class="card">
            <div class="card-header bg-success text-white">Edit Profil Anda</div>
            <div class="card-body">
                @php
                    $loginUser = auth()->user();
                    $biodata = $loginUser->biodata;
                @endphp
                @if ($biodata)
                    <form action="{{ route('user.update', $biodata->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama_user" class="form-control"
                                value="{{ old('nama_user', $biodata->nama_user ?? '') }}">
                            @error('nama_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $loginUser->email ?? '') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control"
                                value="{{ old('telepon', $biodata->telepon ?? '') }}">
                            @error('telepon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control">{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if (!empty($biodata->foto))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $biodata->foto) }}" width="150"
                                        class="rounded shadow">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Ubah Profil
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Biodata belum tersedia. Silakan hubungi administrator atau lengkapi biodata terlebih dahulu.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
