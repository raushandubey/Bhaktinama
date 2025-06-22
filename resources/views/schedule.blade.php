<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule – Bhaktinama.com</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   



</head>
<body>
    <header>
        <h1>Choose Date & Time Slot</h1>
        <nav>
            <a href="/index">Home</a>
        </nav>
    </header>
    <main>
        <label for="datePicker">Select Date:</label>
        <input type="date" id="datePicker" required>
        <div id="timeSlots" class="grid"></div>
    </main>
    
<script src="{{ asset('js/script.js') }}"></script> 

</body>
</html> 