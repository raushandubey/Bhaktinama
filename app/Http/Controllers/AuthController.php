<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\PanditDetail;

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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the user exists and has the correct role
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->role !== 'user') {
            return back()->withErrors([
                'email' => 'This email is not registered as a user. If you are a pandit, please use the pandit login.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
            'dob' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/'],
        ], [
            'name.regex' => 'The name field should only contain letters and spaces.',
            'mobile.regex' => 'Please enter a valid 10-digit mobile number.',
            'dob.before' => 'Date of birth must be a date before today.',
            'address.max' => 'The address should not exceed 500 characters.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least one letter and one number.',
        ]);

        // Check if email is already registered as a pandit
        $existingPandit = User::where('email', $validated['email'])
            ->where('role', 'pandit')
            ->exists();

        if ($existingPandit) {
            return back()->withErrors([
                'email' => 'This email is already registered as a pandit. Please use a different email.',
            ])->onlyInput('email');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'role' => 'user'
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
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

    public function showPanditSignup()
    {
        return view('panditsignup');
    }

    public function showPanditLogin()
    {
        return view('panditlogin');
    }

    public function registerPandit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Password::defaults()],
            'experience' => 'required|integer|min:0',
            'specialization' => 'required|string|max:255',
            'about' => 'nullable|string|max:1000',
        ]);

        // Check if email is already registered as a user
        $existingUser = User::where('email', $validated['email'])
            ->where('role', 'user')
            ->exists();

        if ($existingUser) {
            return back()->withErrors([
                'email' => 'This email is already registered as a user. Please use a different email.',
            ])->onlyInput('email');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'pandit'
        ]);

        // Create pandit details
        PanditDetail::create([
            'user_id' => $user->id,
            'experience' => $validated['experience'],
            'specialization' => $validated['specialization'],
            'about' => $validated['about'],
            'availability' => true
        ]);

        Auth::login($user);
        return redirect()->route('pandit.dashboard')->with('success', 'Pandit account created successfully!');
    }

    public function loginPandit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the user exists and has the correct role
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->role !== 'pandit') {
            return back()->withErrors([
                'email' => 'This email is not registered as a pandit. If you are a user, please use the regular login.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('pandit.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showUpdateProfile()
    {
        $user = Auth::user();
        if ($user->role !== 'pandit') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        return view('pandit.update-profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'pandit') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'experience' => 'required|integer|min:0',
            'specialization' => 'required|string|max:255',
            'about' => 'nullable|string|max:1000',
        ]);

        // Update user details
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->save();

        // Update or create pandit details
        $panditDetail = $user->panditDetail ?? new \App\Models\PanditDetail(['user_id' => $user->id]);
        $panditDetail->experience = $validated['experience'];
        $panditDetail->specialization = $validated['specialization'];
        $panditDetail->about = $validated['about'];
        $panditDetail->save();

        return redirect()->route('pandit.profile.edit')
            ->with('success', 'Profile updated successfully!');
    }
} 