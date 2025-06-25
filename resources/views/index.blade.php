<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhaktinama.com – Book Pandit Appointment</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>
<body> 
    <header class="navbar">
        <div class="logo" onclick="window.location.href='/index'" style="cursor:pointer;">
            <!-- <img src="{{ asset('images/WhatsApp Image 2025-05-28 at 22.20.33_b3f6ad17.jpg') }}" alt="Logo"> -->
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
    <section class="hero">
        <div class="hero-content">
            <h1>Book Pandit Services Online</h1>
            <p>Choose your ritual, select a slot, and get the best Pandits at your doorstep. Fast, easy, and secure!</p>
            @auth
                <div class="quick-book-section">
                    <h3>Quick Book Your Puja</h3>
                    <p>You're logged in! Select a puja to book immediately:</p>
                    <div class="quick-puja-grid">
                        <button class="quick-puja-btn" data-puja="Satyanarayan Puja">Satyanarayan Puja</button>
                        <button class="quick-puja-btn" data-puja="Griha Pravesh Puja">Griha Pravesh</button>
                        <button class="quick-puja-btn" data-puja="Vahana Puja">Vahana Puja</button>
                        <button class="quick-puja-btn" data-puja="Lakshmi Ganesh Puja">Lakshmi Ganesh</button>
                    </div>
                </div>
            @else
                <a href="/signup" class="cta-btn">Get Started <i class="fa fa-arrow-right"></i></a>
            @endauth
        </div>
    </section>
    <main>
        <section class="features">
            <div class="feature-card animate-on-scroll">
                <i class="fa fa-calendar-check fa-2x"></i>
                <h3>Easy Scheduling</h3>
                <p>Pick your preferred date and time slot with real-time availability.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <i class="fa fa-user-tie fa-2x"></i>
                <h3>Verified Pandits</h3>
                <p>Choose from a list of experienced and reviewed Pandits.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <i class="fa fa-credit-card fa-2x"></i>
                <h3>Secure Payments</h3>
                <p>Pay online with confidence. Your details are safe with us.</p>
            </div>
        </section>

        <section class="puja-services">
            <h2 class="section-title">Our Puja Services</h2>
            <div class="puja-grid">
            <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Puja.jpg') }}" alt="Only Puja">
                    <h3>Only Puja</h3>
                    <p>For prosperity, happiness, and well-being of the family.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Satyanarayan Puja.jpg') }}" alt="Satyanarayan Puja">
                    <h3>Satyanarayan Puja</h3>
                    <p>For prosperity, happiness, and well-being of the family.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Griha Pravesh puja.jpg') }}" alt="Griha Pravesh">
                    <h3>Griha Pravesh Puja</h3>
                    <p>Bless your new home with positive energy and divine grace.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Vahana Puja.jpg') }}" alt="Vahana Puja">
                    <h3>Vahana Puja</h3>
                    <p>To bless your new vehicle and ensure safety on the road.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Lakshmi Ganesh Puja.jpg') }}" alt="Lakshmi Ganesh Puja">
                    <h3>Lakshmi Ganesh Puja</h3>
                    <p>For wealth, prosperity, and removal of obstacles. Ideal for Diwali.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                 <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Rudrabhishek shiv puja.jpg') }}" alt="Rudrabhishek">
                    <h3>Rudrabhishek</h3>
                    <p>A powerful puja to please Lord Shiva and gain his blessings.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
                 <div class="puja-card animate-on-scroll">
                    <img src="{{ asset('images/Marriage Ceremony puja.jpg') }}" alt="Marriage Ceremony">
                    <h3>Marriage Ceremony</h3>
                    <p>Conduct your wedding with traditional Vedic rituals.</p>
                    <a href="/signup" class="cta-btn">Book Now</a>
                </div>
            </div>
        </section>
        
    </main>
    <footer>
        <p>&copy; 2025 Bhaktinama.com. All rights reserved. 
            <br>designed by Raushan Dubey ,Ankit Razzput & Mangal Kumar</p>
    </footer>
    
    <script src="{{ asset('js/script.js') }}"></script>
    
   
    
</body>
</html> 