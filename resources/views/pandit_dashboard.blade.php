<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandit Dashboard – Bhaktinama.com</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f7f7fa; }
        .dashboard-container { max-width: 900px; margin: 2rem auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 2rem; }
        .dashboard-header { display: flex; align-items: center; justify-content: space-between; }
        .profile-info { display: flex; align-items: center; gap: 1.5rem; }
        .profile-avatar { width: 70px; height: 70px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #d4af37; }
        .welcome { font-size: 1.5rem; font-weight: 600; }
        .section { margin-top: 2.5rem; }
        .section-title { font-size: 1.2rem; font-weight: 500; color: #d4af37; margin-bottom: 1rem; }
        .card-list { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .card { background: #faf9f6; border-radius: 10px; padding: 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .logout-btn { background: #d9534f; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; transition: background 0.2s; }
        .logout-btn:hover { background: #c9302c; }
        @media (max-width: 700px) { .card-list { grid-template-columns: 1fr; } .dashboard-container { padding: 1rem; } }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="profile-info">
                <div class="profile-avatar"><i class="fa fa-user-tie"></i></div>
                <div>
                    <div class="welcome">Welcome, {{ Auth::user()->name }}!</div>
                    <div style="color:#888; font-size:0.95rem;">Pandit | {{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>

        <div class="section">
            <div class="section-title"><i class="fa fa-calendar-alt"></i> Upcoming Bookings</div>
            <div class="card-list">
                <div class="card" style="text-align:center; color:#aaa;">No bookings yet.<br>Bookings assigned to you will appear here.</div>
            </div>
        </div>

        <div class="section">
            <div class="section-title"><i class="fa fa-star"></i> Feedback</div>
            <div class="card-list">
                <div class="card" style="text-align:center; color:#aaa;">No feedback yet.<br>Feedback from users will appear here.</div>
            </div>
        </div>
    </div>
</body>
</html> 