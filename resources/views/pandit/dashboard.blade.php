<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandit Dashboard - Bhaktinama</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                
            <!-- <img src="{{ asset('images/WhatsApp Image 2025-05-28 at 22.20.33_b3f6ad17.jpg') }}" alt="Logo"> -->
            <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;"> 
            <i class="fas fa-om" style="font-size: 24px; color: #d4af37; margin-right: 10px;"></i>
            <span>Bhaktinama.com</span>
        </div>
                
               
                </a>
            </div>
            <nav>
                <ul>
                  
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h1>Welcome to Pandit Dashboard</h1>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="dashboard-content">
                <h2>Your Profile</h2>
                <div class="profile-info">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Mobile:</strong> {{ Auth::user()->mobile }}</p>
                    <p><strong>Address:</strong> {{ Auth::user()->address }}</p>
                </div>
                
                <h2>Your Bookings</h2>
                <div class="bookings-list">
                    <p>No bookings yet.</p>
                    <!-- You can add booking listing logic here later -->
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>