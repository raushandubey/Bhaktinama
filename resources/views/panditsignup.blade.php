<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup – Bhaktinama.com</title>
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
            <a href="/login">Login</a>
        </nav>
    </header>
    <main>
        <div class="form-card animate-card">
            <h2 class="page-title"><i class="fa fa-user-plus"></i> Create Your Account</h2>
            <p class="info-text">Sign up to book Pandit services, manage your appointments, and enjoy a seamless spiritual experience.</p>
            
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

            <form method="POST" action="{{ route('panditsignup.post') }}" id="signupForm">
                @csrf
                <label>
                    Name:
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your Full Name">
                </label>
                <label>
                    Email:
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@email.com">
                </label>
                <label>
                    Mobile:
                    <input type="tel" name="mobile" value="{{ old('mobile') }}" required placeholder="10-digit Mobile">
                </label>
                <label>
                    Date of Birth:
                    <input type="date" name="dob" value="{{ old('dob') }}" required>
                </label>
                <label>
                    Address:
                    <textarea name="address" required placeholder="Your Address">{{ old('address') }}</textarea>
                </label>
                <label>
                    Password:
                    <input type="password" name="password" required placeholder="Minimum 6 characters">
                </label>
                <label>
                    Confirm Password:
                    <input type="password" name="password_confirmation" required placeholder="Confirm your password">
                </label>
                <button type="submit" class="cta-btn">Sign Up</button>
            </form>
            
            <div class="auth-links">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
            <div class="auth-links">
                <p>For New User Registration <a href="{{ route('signup') }}">click here</a></p>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 