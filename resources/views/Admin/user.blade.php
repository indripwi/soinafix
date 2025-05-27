@extends('layouts.Admin')

@section('content')
<div class="container">
    <h1>Daftar Pengguna</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
            @foreach($users as $user)
            <tr>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telepon }}</td>
                <td>{{ $user->alamat }}</td>
                <td>
                    @if($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" width="50">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama_user" class="form-control" value="{{ old('nama_user', $user->nama_user ?? '') }}">
    @error('nama_user') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $user->telepon ?? '') }}">
    @error('telepon') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control">{{ old('alamat', $user->alamat ?? '') }}</textarea>
    @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label>Foto</label>
    <input type="file" name="foto" class="form-control">
    @error('foto') <div class="text-danger">{{ $message }}</div> @enderror

    @if(!empty($user->foto))
        <img src="{{ asset('storage/' . $user->foto) }}" width="100" class="mt-2">
    @endif
</div>

@endsection
