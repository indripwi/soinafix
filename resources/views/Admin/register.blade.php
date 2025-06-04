<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif
</body>
</html>
