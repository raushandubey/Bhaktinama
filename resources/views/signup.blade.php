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
            <form id="signupForm">
                <label>Name:<input type="text" name="name" required placeholder="Your Full Name"></label>
                <label>Email:<input type="email" name="email" required placeholder="you@email.com"></label>
                <label>Mobile:<input type="tel" name="mobile" required placeholder="10-digit Mobile"></label>
                <label>Date of Birth:<input type="date" name="dob" required></label>
                <label>Address:<textarea name="address" required placeholder="Your Address"></textarea></label>
                <button type="submit" class="cta-btn">Sign Up</button>
            </form>
        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 