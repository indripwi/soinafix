@extends('layouts.Pengguna')

@section('title', 'Login Pengguna')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" required>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>

        <p class="mt-4 text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 underline">Daftar di sini</a></p>
    </form>
</div>
@endsection
