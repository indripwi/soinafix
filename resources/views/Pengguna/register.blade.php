@extends('layouts.Pengguna')

@section('title', 'Registrasi Pengguna')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Registrasi</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}" required>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</button>

        <p class="mt-4 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 underline">Login di sini</a></p>
    </form>
</div>
@endsection
