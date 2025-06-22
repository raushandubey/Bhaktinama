<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings – Bhaktinama.com</title>
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
            <a href="/pandit">Book Pandit</a>
        </nav>
    </header>
    <main>
        <h2 class="page-title"><i class="fa fa-calendar-check"></i> My Bookings</h2>
        <div id="bookingsList" class="bookings-list"></div>
    </main>
    <div id="bookingModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modalBookingDetails"></div>
        </div>
    </div>

  <script src="{{ asset('js/script.js') }}"></script>

   
</body>
</html> 