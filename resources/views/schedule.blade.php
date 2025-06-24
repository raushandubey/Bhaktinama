<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule – Bhaktinama.com</title>
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
        <div class="form-card animate-card">
            <h2 class="page-title"><i class="fa fa-calendar-alt"></i> Schedule Your Puja</h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div id="selectedPuja" class="selected-puja">
                <h3>Selected Puja: <span id="pujaName">Loading...</span></h3>
            </div>
            
            <div class="schedule-form">
                <label for="datePicker">Select Date:</label>
                <input type="date" id="datePicker" required min="{{ date('Y-m-d') }}">
                <div id="timeSlots" class="grid"></div>
            </div>
        </div>
    </main>
    
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Display selected puja
        document.addEventListener('DOMContentLoaded', function() {
            const pujaName = localStorage.getItem('bhakti_puja') || 'General Puja';
            document.getElementById('pujaName').textContent = pujaName;
        });
    </script>
</body>
</html> 