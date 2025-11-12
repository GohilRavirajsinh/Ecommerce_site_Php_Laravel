<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Register/Register.css') }}">
    <title>Login Here</title>
    </link>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <h1>Create Account</h1>

                <div class="social-icons">
                    <a href="#" class="icon">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>

                <span>or use your email for
                    registration</span>
                <input type="text" placeholder="name" name="name">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button>Sign Up</button>

            </form>
        </div>
        <div class="form-container sign-in">
            <!-- For User Registration -->
            <form action="{{ route('register.login') }}" method="post">
                @csrf
                <h1>Sign In</h1>

                <div class="social-icons">
                    <a href="#" class="icon">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>

                <span>or use your email and password</span>
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <a href="#">Forgrt Your Passwrod?</a>
                <button>Sign In</button>

            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back !</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, You!</h1>
                    <p>Register your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('Register/Register.js') }}"></script>
</body>

</html>