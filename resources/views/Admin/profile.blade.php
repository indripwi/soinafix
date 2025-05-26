@extends('layouts.admin') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Profil Pengguna Aplikasi</h2>

    <div class="row">
        {{-- Foto Profil --}}
        <div class="col-md-4 text-center">
            <div class="mb-3">
                <img src="{{ asset('storage/foto/' . $user->profile->foto) }}" 
                     alt="Foto Profil" class="img-thumbnail rounded-circle" width="200">
            </div>
            <form action="{{ route('profile.updateFoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" name="foto" class="form-control mb-2">
                <button type="submit" class="btn btn-info">Ganti Foto</button>
            </form>
        </div>

        {{-- Data Profil --}}
        <div class="col-md-8">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                </div>
                <div class="mb-2">
                    <label>Telepon</label>
                    <input type="text" name="telepon" value="{{ $user->profile->telepon }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label>NIK (KTP)</label>
                    <input type="text" name="nik" value="{{ $user->profile->nik }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="{{ $user->profile->alamat }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Ubah Profil</button>
            </form>
        </div>
    </div>

    <hr class="my-4">

    {{-- Ubah Password --}}
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('profile.updatePassword') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label>Username</label>
                    <input type="text" value="{{ $user->username }}" class="form-control" readonly>
                </div>
                <div class="mb-2">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
