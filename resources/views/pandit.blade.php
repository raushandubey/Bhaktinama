<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Pandit – Bhaktinama.com</title>
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
        <h2 class="page-title"><i class="fa fa-user-tie"></i> Choose Your Pandit</h2>
        <p class="info-text">Select a Pandit for your ritual. You can view their experience, reviews, and more details before making your choice. All our Pandits are verified and highly rated!</p>
        
        @auth
            <div data-user-name="{{ Auth::user()->name }}" data-user-mobile="{{ Auth::user()->mobile }}" style="display:none;"></div>
        @endauth
        
        <form id="panditForm">
            <div id="panditCards" class="pandit-cards"></div>
            <button type="submit" class="cta-btn" style="margin-top:2rem;">Proceed</button>
        </form>
    </main>
    <div id="panditModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modalDetails"></div>
        </div>
    </div>
    
  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html> 