@extends('layouts.app')

@section('title', 'Forgot Password – Bhaktinama.com')

@section('content')
<main>
    <div class="form-card animate-on-scroll" data-animation="animate-fade-in">
        <h2 class="page-title"><i class="fa fa-key"></i> Forgot Password</h2>
        <p class="info-text">Enter your email and date of birth to reset your password.</p>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf
            <label>
                Email:
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="your@email.com">
            </label>
            <label>
                Date of Birth:
                <input type="date" name="dob" required>
            </label>
            <button type="submit" class="cta-btn">Verify Account</button>
        </form>
    </div>
</main>
@endsection 