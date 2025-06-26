<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showSignup()
    {
        return view('signup');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Check if user was trying to book a puja
            $intendedUrl = session('url.intended', '/index');
            if (str_contains($intendedUrl, '/schedule') || str_contains($intendedUrl, '/pandit')) {
                return redirect()->intended('/schedule')->with('success', 'Welcome back! You can now proceed with your booking.');
            }
            
            return redirect()->intended('/index')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'Username or password was wrong.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:15',
            'dob' => 'required|date',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/index')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/index')->with('success', 'You have been logged out successfully.');
    }

    // --- Password Reset Methods ---

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyUserForPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'dob' => 'required|date',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->dob == $request->dob) {
            // The "token" here is just the user's email, not a real security token.
            // This is just to satisfy the route parameter.
            return redirect()->route('password.reset', ['token' => 'reset', 'email' => $user->email]);
        }

        return back()->with('error', 'The provided email and date of birth do not match our records.');
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Log the user in after password reset
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Your password has been reset successfully!');
        }

        return back()->withErrors(['email' => 'An unexpected error occurred. Please try again.']);
    }
} 