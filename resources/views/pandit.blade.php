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
        <div class="logo">
            <span>Bhaktinama.com</span>
        </div>
        <nav>
            <a href="/index">Home</a>
            <a href="/history">My Bookings</a>
        </nav>
    </header>
    <main>
        <h2 class="page-title"><i class="fa fa-user-tie"></i> Choose Your Pandit</h2>
        <p class="info-text">Select a Pandit for your ritual. You can view their experience, reviews, and more details before making your choice. All our Pandits are verified and highly rated!</p>
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