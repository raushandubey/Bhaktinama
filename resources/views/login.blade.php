<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Bhaktinama.com</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <span>Bhaktinama.com</span>
        </div>
        <nav>
            <a href="/index">Home</a>
            <a href="/signup">Signup</a>
        </nav>
    </header>
    <main>
        <form id="loginForm" class="auth-form">
            <h2>Login</h2>
            <label>Email or Mobile:<input type="text" name="login" required></label>
            <label>Password:<input type="password" name="password" required></label>
            <button type="submit">Login</button>
        </form>
    </main>
   
  
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 