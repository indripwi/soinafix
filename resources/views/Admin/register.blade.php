<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up & Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input:focus {
            border-color: #ff7a00;
            outline: none;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #666;
        }

        button {
            background-color: #cb2e3b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
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

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>

<body>
    @if (session('registerSuccess'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Tampilkan form login dan sembunyikan form daftar
                document.getElementById("signInForm").classList.remove("hidden");
                document.getElementById("signUpForm").classList.add("hidden");

                // Tampilkan notifikasi sukses
                alert("{{ session('registerSuccess') }}");
            });
        </script>
    @endif

    <div class="container">
        {{-- Register --}}
        <div id="signUpForm">
            <h2>Daftar</h2>

            @if (session('status'))
                <div style="color: green; text-align:center;">{{ session('status') }}</div>
            @endif

            @if (session('message'))
                <div style="color: red; text-align:center;">{{ session('message') }}</div>
            @endif

            <div id="passwordError" class="error-message">Password dan Konfirmasi Password tidak sama.</div>

            @if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <form action="{{ route('register.process') }}" method="POST" enctype="multipart/form-data"
                id="registerForm">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Email" required>

                <div class="password-wrapper">
                    <input type="password" name="password" id="registerPassword" placeholder="Password" required>
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('registerPassword', this)"></i>
                </div>

                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="registerConfirm"
                        placeholder="Konfirmasi Password" required>
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('registerConfirm', this)"></i>
                </div>

                <button type="submit">Daftar</button>
            </form>

            <div class="switch">
                Sudah punya akun? <a href="#" onclick="toggleForms()">Login</a>
            </div>
            <div class="switch">
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
        </div>

        {{-- Login --}}
        <div id="signInForm" class="hidden">
            <h2>Login</h2>

            @if (session('status'))
                <div style="color: green; text-align:center;">{{ session('status') }}</div>
            @endif

            @if (session('message'))
                <div style="color: red; text-align:center;">{{ session('message') }}</div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama Pengguna" required>

                <div class="password-wrapper">
                    <input type="password" id="password-login" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('loginPassword', this)"></i>
                </div>

                <button type="submit">Login</button>
            </form>

            <div class="switch">
                Belum punya akun? <a href="{{ route('register') }}" onclick="toggleForms()">Daftar</a>
            </div>
            <div class="switch">
                <a href="{{ route('password.request') }}">Lupa Password?</a>
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

        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function validatePassword() {
            const password = document.getElementById("registerPassword").value;
            const confirm = document.getElementById("registerConfirm").value;
            const errorDiv = document.getElementById("passwordError");

            if (password !== confirm) {
                errorDiv.style.display = "block";
            } else {
                errorDiv.style.display = "none";
                document.getElementById("registerForm").submit();
            }
        }

        // Clear guest modal flag if any
        localStorage.removeItem("guestModalShown");
    </script>
</body>

</html>
