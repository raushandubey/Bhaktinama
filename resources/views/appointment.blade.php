<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment – Bhaktinama.com</title>
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
            @auth
                <span class="welcome-text">Welcome, {{ Auth::user()->name }}!</span>
                <a href="/history">My Bookings</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn">Logout</button>
                </form>
            @else
                <a href="/signup">Signup</a>
                <a href="/login">Login</a>
            @endauth
        </nav>
    </header>
    <main>
        <div class="progress-bar">
            <div class="step completed"><i class="fa fa-user-plus"></i><span>Signup</span></div>
            <div class="step completed"><i class="fa fa-calendar"></i><span>Schedule</span></div>
            <div class="step completed"><i class="fa fa-user-tie"></i><span>Pandit</span></div>
            <div class="step active"><i class="fa fa-check-circle"></i><span>Confirm</span></div>
        </div>
        <div class="form-card animate-card" style="margin-top:2rem;">
            <h2 class="page-title"><i class="fa fa-check-circle"></i> Appointment Confirmation</h2>
            @auth
                <div data-user-name="{{ Auth::user()->name }}" data-user-mobile="{{ Auth::user()->mobile }}" style="display:none;"></div>
            @endauth
            <div id="appointmentDetails"></div>
            <button id="payNowBtn" class="cta-btn">Pay Now</button>
            <div id="paymentBox" style="display:none;">
                <p><i class="fa fa-check-circle" style="color:#4caf50;"></i> Dummy Payment Box – Payment Successful!</p>
            </div>
        </div>
    </main>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 