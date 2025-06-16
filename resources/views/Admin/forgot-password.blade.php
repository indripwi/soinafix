<!-- resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #cb2e3b, #ff7a00);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease-in-out;
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.4s ease-in-out;
        }

        input {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #ff7a00;
            outline: none;
        }

        button {
            background-color: #cb2e3b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background-color: #b92331;
        }

        .switch {
            text-align: center;
            margin-top: 12px;
            font-size: 14px;
        }

        .switch a {
            color: #cb2e3b;
            font-weight: 500;
            text-decoration: none;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .form-toggle {
            transition: opacity 0.4s ease, transform 0.4s ease;
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
