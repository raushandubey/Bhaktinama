  
            <!-- <img src="{{ asset('images/WhatsApp Image 2025-05-28 at 22.20.33_b3f6ad17.jpg') }}" alt="Logo"> -->
            <div class="bhaktinama-header">
                <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;">
                <i class="fas fa-om bhaktinama-om-icon"></i>
                <span class="bhaktinama-title">Bhaktinama.com</span>
            </div>
            <

<!-- Add required CSS -->
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="dashboard-container">
    <div class="container-fluid px-4">
        <!-- Profile Completion Alert -->
        @if(!auth()->user()->profile_completed)
        <div class="row mb-4" data-aos="fade-down">
            <div class="col-12">
                <div class="alert-card">
                    <div class="alert-content">
                        <div class="alert-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="alert-text">
                            <h3>Complete Your Profile</h3>
                            <p>Please complete your profile to start accepting puja bookings. This will help devotees know more about you and your services.</p>
                            <a href="{{ route('pandit.profile.edit') }}" class="btn btn-light">
                                <i class="fas fa-arrow-right"></i> Update Profile Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Welcome Section -->
        <div class="row mb-4" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-card">
                    <div class="welcome-content">
                        <div class="avatar-wrapper" data-aos="zoom-in" data-aos-delay="200">
                            <div class="avatar-circle">
                                @if(auth()->user()->profile_picture)
                                    <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile Picture" class="profile-image">
                                @else
                                    <span class="initials">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                @endif
                                <div class="avatar-decoration"></div>
                            </div>
                        </div>
                        <div class="welcome-text" data-aos="fade-right" data-aos-delay="400">
                            <h1 class="welcome-title">
                                <span class="namaste">🕉️ नमस्ते,</span><br>
                                {{ Auth::user()->name }} जी! 🙏
                            </h1>
                            <p class="welcome-subtitle">आपका भक्तिनामा में स्वागत है</p>
                            @if(auth()->user()->profile_completed)
                                <div class="profile-status complete">
                                    <i class="fas fa-check-circle"></i> Profile Complete
                                </div>
                            @else
                                <div class="profile-status incomplete">
                                    <i class="fas fa-exclamation-circle"></i> Profile Incomplete
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card hoverable">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Today's Bookings</h3>
                        <div class="stat-value">0</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card hoverable">
                    <div class="stat-icon">
                        <i class="fas fa-om"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Pujas</h3>
                        <div class="stat-value">0</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="stat-card hoverable">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Rating</h3>
                        <div class="stat-value">5.0 ⭐</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="row mb-4">
            <div class="col-12" data-aos="fade-up">
                <div class="notification-section hoverable">
                    <h2 class="section-title">
                        <i class="fas fa-bell"></i> Notifications
                    </h2>
                    <div class="notification-list">
                        @if(session('success'))
                            <div class="notification-item success-notification" data-aos="fade-left">
                                <div class="notification-time">{{ date('F d, Y') }}</div>
                                <div class="notification-content">
                                    <i class="fas fa-check-circle"></i>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="notification-item" data-aos="fade-left" data-aos-delay="200">
                            <div class="notification-time">{{ date('F d, Y') }}</div>
                            <div class="notification-content">
                                <i class="fas fa-pray"></i>
                                <strong>Welcome to Bhaktinama!</strong>
                                <p>Namaste {{ Auth::user()->name }} Ji, Your divine journey as a Pandit begins here. Your account has been successfully verified. You can now start accepting puja bookings and serve the community.</p>
                            </div>
                        </div>
                        <div class="notification-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="notification-time">{{ date('F d, Y') }}</div>
                            <div class="notification-content">
                                <i class="fas fa-user-shield"></i>
                                <strong>Admin Notification</strong>
                                <p>Our admin team has been notified of your registration. They will review your profile and may contact you for any additional information if needed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="quick-actions hoverable">
                    <h2 class="section-title">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h2>
                    <div class="action-buttons">
                        <a href="#" class="action-button" data-aos="zoom-in" data-aos-delay="200">
                            <i class="fas fa-calendar-plus"></i>
                            <span>View Bookings</span>
                        </a>
                        <a href="{{ route('pandit.profile.edit') }}" class="action-button" data-aos="zoom-in" data-aos-delay="400">
                            <i class="fas fa-user-edit"></i>
                            <span>Update Profile</span>
                        </a>
                        <a href="#" class="action-button" data-aos="zoom-in" data-aos-delay="600">
                            <i class="fas fa-question-circle"></i>
                            <span>Get Help</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #FF8C42;
    --secondary-color: #FF3C38;
    --accent-color: #FFA62B;
    --text-color: #2D3436;
    --bg-color: #F8F9FA;
    --card-bg: #FFFFFF;
    --shadow-color: rgba(0, 0, 0, 0.1);
}

/* Base Styles */
.dashboard-container {
    padding: 2rem 0;
    background-color: var(--bg-color);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
}

/* Welcome Card */
.welcome-card {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 20px;
    padding: 2.5rem;
    color: white;
    box-shadow: 0 15px 30px var(--shadow-color);
    position: relative;
    overflow: hidden;
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.1)' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.1;
}

.welcome-content {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    position: relative;
    z-index: 1;
}

.avatar-circle {
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border: 4px solid rgba(255,255,255,0.3);
    animation: float 6s ease-in-out infinite;
}

.avatar-decoration {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px dashed rgba(255,255,255,0.5);
    animation: spin 20s linear infinite;
}

.initials {
    font-size: 3rem;
    color: white;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.welcome-title {
    font-size: 2.8rem;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: white;
    line-height: 1.2;
}

.welcome-subtitle {
    font-size: 1.4rem;
    opacity: 0.9;
    color: white;
    margin-top: 0.5rem;
}

.namaste {
    font-size: 2.2rem;
    font-weight: normal;
    display: inline-block;
    animation: wave 2s infinite;
}

/* Stats Cards */
.stat-card {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 1.8rem;
    display: flex;
    align-items: center;
    gap: 1.8rem;
    box-shadow: 0 8px 20px var(--shadow-color);
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.1);
}

.stat-card.hoverable:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 12px 30px var(--shadow-color);
}

.stat-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: rotate(15deg);
}

.stat-icon i {
    font-size: 2rem;
    color: white;
}

.stat-info h3 {
    font-size: 1rem;
    color: var(--text-color);
    margin-bottom: 0.8rem;
    font-weight: 500;
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    color: var(--text-color);
    line-height: 1;
}

/* Notifications */
.notification-section {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 20px var(--shadow-color);
}

.section-title {
    font-size: 1.8rem;
    color: var(--text-color);
    margin-bottom: 1.8rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    font-weight: 600;
}

.notification-item {
    padding: 1.5rem;
    border-left: 4px solid var(--primary-color);
    background-color: var(--card-bg);
    margin-bottom: 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px var(--shadow-color);
}

.notification-item:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px var(--shadow-color);
}

.notification-time {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.8rem;
}

.notification-content {
    color: var(--text-color);
}

.notification-content i {
    margin-right: 0.8rem;
    color: var(--primary-color);
}

/* Quick Actions */
.quick-actions {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 20px var(--shadow-color);
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    padding: 1.2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.action-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: translateX(-100%);
    transition: 0.5s;
}

.action-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255,140,66,0.3);
    color: white;
}

.action-button:hover::before {
    transform: translateX(100%);
}

.action-button i {
    font-size: 1.8rem;
}

/* Animations */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-10deg); }
    75% { transform: rotate(10deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-content {
        flex-direction: column;
        text-align: center;
    }

    .welcome-title {
        font-size: 2.2rem;
    }

    .welcome-subtitle {
        font-size: 1.2rem;
    }

    .stat-card {
        margin-bottom: 1rem;
    }

    .action-buttons {
        grid-template-columns: 1fr;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    :root {
        --bg-color: #1a1a1a;
        --card-bg: #2d2d2d;
        --text-color: #f8f9fa;
        --shadow-color: rgba(0,0,0,0.3);
    }

    .stat-info h3, .notification-time {
        color: #adb5bd;
    }
}

/* Profile Status Styles */
.profile-status {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-top: 1rem;
}

.profile-status.complete {
    background-color: rgba(25, 135, 84, 0.2);
    color: #198754;
}

.profile-status.incomplete {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
}

.profile-status i {
    margin-right: 0.5rem;
}

/* Alert Card Styles */
.alert-card {
    background: linear-gradient(135deg, #FF6B6B, #FF8E53);
    border-radius: 15px;
    padding: 1.5rem;
    color: white;
    box-shadow: 0 10px 20px rgba(255, 107, 107, 0.2);
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.alert-icon {
    background: rgba(255, 255, 255, 0.2);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-icon i {
    font-size: 1.8rem;
    color: white;
}

.alert-text {
    flex: 1;
}

.alert-text h3 {
    font-size: 1.4rem;
    margin-bottom: 0.5rem;
}

.alert-text p {
    margin-bottom: 1rem;
    opacity: 0.9;
}

.alert-text .btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.4);
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.alert-text .btn:hover {
    background: white;
    color: #FF6B6B;
    transform: translateY(-2px);
}

.alert-text .btn i {
    margin-left: 0.5rem;
}

/* Profile Image Styles */
.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* Responsive Alert Card */
@media (max-width: 576px) {
    .alert-content {
        flex-direction: column;
        text-align: center;
    }

    .alert-icon {
        margin-bottom: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: true
    });
});
</script>
