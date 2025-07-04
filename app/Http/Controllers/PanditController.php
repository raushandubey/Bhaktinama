<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PanditDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewPanditRegistration;

class PanditController extends Controller
{
    public function index()
    {
        $pandits = User::where('role', 'pandit')
            ->whereHas('panditDetail', function($query) {
                $query->where('is_verified', true)
                      ->where('is_available', true);
            })
            ->with('panditDetail')
            ->get()
            ->map(function($pandit) {
                return [
                    'id' => $pandit->id,
                    'name' => "Pandit " . $pandit->name,
                    'title' => $pandit->panditDetail->title,
                    'specialization' => $pandit->panditDetail->specialization,
                    'rating' => $pandit->panditDetail->rating,
                    'description' => $pandit->panditDetail->description,
                    'phone' => $pandit->panditDetail->phone,
                    'profile_picture' => $pandit->profile_picture ? asset('storage/' . $pandit->profile_picture) : asset('images/default-avatar.png'),
                    'experience_years' => $pandit->panditDetail->experience_years,
                    'completed_pujas' => $pandit->panditDetail->completed_pujas,
                    'expertise_areas' => $pandit->panditDetail->expertise_areas,
                    'languages_known' => $pandit->panditDetail->languages_known,
                ];
            });

        return view('pandits.index', compact('pandits'));
    }

    public function show($id)
    {
        $pandit = User::where('role', 'pandit')
            ->with('panditDetail')
            ->findOrFail($id);

        return view('pandits.show', compact('pandit'));
    }

    public function showUpdateProfile()
    {
        $user = auth()->user();
        $panditDetail = $user->panditDetail;
        
        return view('pandit.update-profile', compact('user', 'panditDetail'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $panditDetail = $user->panditDetail ?? new PanditDetail(['user_id' => $user->id]);

        try {
            DB::beginTransaction();

            // Validate request
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'dob' => 'required|date',
                'experience' => 'required|integer|min:0',
                'specialization' => 'required|array|min:1',
                'specialization.*' => 'string|in:satyanarayan,griha_pravesh,marriage,rudrabhishek,lakshmi_puja,ganesh_puja,navagraha,kaal_sarp',
                'languages' => 'required|array|min:1',
                'languages.*' => 'string|in:hindi,sanskrit,english,marathi,gujarati,bengali',
                'bio' => 'required|string|min:50',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'address' => 'required|string',
                'travel_distance' => 'required|integer|min:0',
                'profile_picture' => 'nullable|image|max:2048',
                'id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'certificates.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ]);

            // Update user details
            $user->name = $validated['full_name'];
            $user->save();

            // Update or create pandit details
            $panditDetail->phone = $validated['phone'];
            $panditDetail->experience_years = $validated['experience'];
            $panditDetail->specialization = json_encode($request->specialization);
            $panditDetail->languages_known = json_encode($request->languages);
            $panditDetail->description = $validated['bio'];
            $panditDetail->city = $validated['city'];
            $panditDetail->state = $validated['state'];
            $panditDetail->address = $validated['address'];
            $panditDetail->travel_distance = $validated['travel_distance'];

            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profile-pictures', 'public');
                $user->profile_picture = $path;
                $user->save();
            }

            // Handle ID proof upload
            if ($request->hasFile('id_proof')) {
                $path = $request->file('id_proof')->store('id-proofs', 'public');
                $panditDetail->id_proof = $path;
            }

            // Handle certificates upload
            if ($request->hasFile('certificates')) {
                $certificatePaths = [];
                foreach ($request->file('certificates') as $certificate) {
                    $certificatePaths[] = $certificate->store('certificates', 'public');
                }
                $panditDetail->certificates = json_encode($certificatePaths);
            }

            $panditDetail->save();

            DB::commit();

            // Send success notification
            session()->flash('success', 'Profile updated successfully!');
            
            // Redirect to success page
            return view('pandit.profile-updated');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update profile. Please try again. Error: ' . $e->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|size:10|regex:/^[0-9]+$/',
            'experience' => 'required|integer|min:0',
            'specialization' => 'required|array|min:1',
            'specialization.*' => 'string|in:satyanarayan,griha_pravesh,marriage,rudrabhishek,lakshmi_puja,ganesh_puja,navagraha,kaal_sarp',
            'about' => 'required|string|min:50',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'profile_picture' => 'nullable|image|max:2048',
            'certificates.*' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'name.regex' => 'Name should only contain letters and spaces',
            'phone.size' => 'Phone number must be exactly 10 digits',
            'phone.regex' => 'Phone number must contain only numbers',
            'specialization.required' => 'Please select at least one specialization',
            'specialization.array' => 'Please select valid specializations',
            'specialization.*.in' => 'Invalid specialization selected',
            'about.min' => 'Please provide a detailed description about yourself (minimum 50 characters)',
            'password.regex' => 'Password must contain at least one letter and one number',
            'profile_picture.max' => 'Profile picture must not exceed 2MB',
            'certificates.*.max' => 'Each certificate must not exceed 2MB',
            'certificates.*.mimes' => 'Certificates must be in PDF or image format'
        ]);

        try {
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pandit'
            ]);

            // Handle profile picture upload
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            // Handle certificates upload
            $certificatePaths = [];
            if ($request->hasFile('certificates')) {
                foreach ($request->file('certificates') as $certificate) {
                    $certificatePaths[] = $certificate->store('certificates', 'public');
                }
            }

            // Create pandit details
            $panditDetails = PanditDetail::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'experience_years' => $request->experience,
                'specialization' => json_encode($request->specialization),
                'description' => $request->about,
                'profile_picture' => $profilePicturePath,
                'certificates' => json_encode($certificatePaths),
                'is_verified' => false,
                'is_available' => true,
                'completed_pujas' => 0,
                'total_reviews' => 0,
                'rating' => 0.0
            ]);

            DB::commit();

            // Send notification to admin about new pandit registration
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $admin->notify(new NewPanditRegistration($user));
            }

            // Log in the user
            auth()->login($user);

            return redirect()->route('pandit.dashboard')
                ->with('success', 'Registration successful! Your account is pending admin approval. You can start setting up your profile in the meantime.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again later.']);
        }
    }
} 