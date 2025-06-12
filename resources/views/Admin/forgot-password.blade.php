<!-- resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password</title>
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
        <h2>Reset Password</h2>

        @if (session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif

        <form action="{{ route('password.send-code') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email">Masukkan Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-danger w-100">Kirim Kode Reset</button>
        </form>
    </div>
</body>

</html>
