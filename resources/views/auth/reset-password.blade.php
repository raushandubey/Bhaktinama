@extends('layouts.app')

@section('title', 'Reset Password – Bhaktinama.com')

@section('content')
<main>
    <div class="form-card">
        <h2 class="page-title"><i class="fa fa-lock"></i> Reset Your Password</h2>

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="auth-form">
            @csrf

            <!-- Hidden email field -->
            <input type="hidden" name="email" value="{{ request()->email }}">

            <label>
                New Password:
                <input type="password" name="password" required placeholder="Enter a new password">
            </label>
            <label>
                Confirm New Password:
                <input type="password" name="password_confirmation" required placeholder="Confirm your new password">
            </label>
            <button type="submit" class="cta-btn">Reset Password</button>
        </form>
    </div>
</main>
@endsection 