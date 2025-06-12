<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 350px;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin: 8px 0;
            padding: 10px;
            font-size: 16px;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            background-color: #cb2e3b;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #c33b01;
        }

        .switch {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .switch a {
            color: #ff4d00;
            text-decoration: none;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Verifikasi Kode</h2>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        <form action="{{ route('password.verify-code') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">

            <div class="form-group mb-3">
                <label for="token">Masukkan Kode OTP</label>
                <input type="text" name="token" class="form-control" required>
                @error('token') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-danger w-100">Verifikasi</button>
        </form>
    </div>
</div>
</body>