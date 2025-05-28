<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up & Sign In</title>
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
            background-color: #ff4d00;
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
        <div id="signInForm">
            <h2>Sign In</h2>
            <form action="{{ route('login.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" id="loginEmail" name="name" placeholder="username" required>
                <input type="password" id="loginPassword" name="password" placeholder="Password" required>
                <button type="submit">Sign In</button>
            </form>

            <div class="switch">
                Belum punya akun? <a href="#" onclick="toggleForms()">Sign Up</a>
            </div>
            <div class="switch">
                <a href="{{ route('google.login') }}" onclick="toggleForms()">
                  Login dengan Google
                </a>
            </div>

            <script>
                function toggleForms() {
                    const signInForm = document.getElementById("signInForm");
                    const signUpForm = document.getElementById("signUpForm");
                    signInForm.classList.toggle("hidden");
                    signUpForm.classList.toggle("hidden");
                }
            </script>
        </div>

        <div id="signUpForm" class="hidden">
            <h2>Sign Up</h2>
            <form>
                <input type="text" placeholder="Nama Lengkap" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <div class="switch">
                Sudah punya akun? <a href="#" onclick="toggleForms()">Sign In</a>
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
