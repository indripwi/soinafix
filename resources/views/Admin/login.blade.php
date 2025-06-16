<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up & Sign In</title>
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
        <div id="signInForm" class="form-toggle">
            <h2>Masuk</h2>
            <form action="{{ route('login.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama Pengguna" required>
                <input type="password" name="password" placeholder="Kata Sandi" required>
                <button type="submit">Login</button>
            </form>
            <div class="switch">
                Belum punya akun? <a href="#" onclick="toggleForms()">buat akun!</a>
            </div>
            <div class="switch">
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
        </div>

        <div id="signUpForm" class="form-toggle hidden">
            <h2>Daftar</h2>
            <form action="{{ route('register.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Kata Sandi" required>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                <button type="submit">Daftar</button>
            </form>
            <div class="switch">
                Sudah punya akun? <a href="#" onclick="toggleForms()">Login</a>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            const signInForm = document.getElementById("signInForm");
            const signUpForm = document.getElementById("signUpForm");
            signInForm.classList.toggle("hidden");
            signUpForm.classList.toggle("hidden");
        }
    </script>

</body>

</html>
