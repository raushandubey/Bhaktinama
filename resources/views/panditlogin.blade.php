<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Bhaktinama.com</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="logo" onclick="window.location.href='/index'" style="cursor:pointer;">
            <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;"> 
            <i class="fas fa-om" style="font-size: 24px; color: #d4af37; margin-right: 10px;"></i>
            <span>Bhaktinama.com</span>
        </div>
        <nav>
            <a href="/index">Home</a>
            <a href="/signup">Signup</a>
        </nav>
    </header>
    <main>
        <div class="form-card animate-on-scroll" data-animation="animate-fade-in">
            <h2 class="page-title"><i class="fa fa-sign-in-alt"></i> Login to Your Account</h2>
            <p class="info-text">Welcome back Pandit jee ! Please login to access your bookings and manage your appointments.</p>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('panditlogin.post') }}" class="auth-form">
                @csrf
                <label>
                    Email:
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                </label>
                <label>
                    Password:
                    <input type="password" name="password" required placeholder="Enter your password">
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" checked>
                    <span>Remember me (Stay logged in)</span>
                </label>

                <div class="auth-links" style="text-align: right; margin-bottom: 15px;">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>

                <button type="submit" class="cta-btn animate-on-scroll" data-animation="animate-zoom-in">Login</button>
            </form>
            
            <div class="auth-links">
                <p>Don't have an account? <a href="{{ route('pandit.signup') }}">Sign up here</a></p>
            </div>
             <div class="auth-links">
                <p>For User Login <a href="{{route('login')}}">click here</a></p>
            </div>
        </div>
    </main>
  
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 