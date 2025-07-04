<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PanditDetail;
use Illuminate\Http\Request;

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

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $panditDetail = $user->panditDetail ?? new PanditDetail(['user_id' => $user->id]);

        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:15',
            'experience_years' => 'required|integer|min:0',
            'expertise_areas' => 'required|array',
            'languages_known' => 'required|array',
        ]);

        // Update pandit details
        $panditDetail->fill($validated);
        $panditDetail->save();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->route('pandit.dashboard')
            ->with('success', 'Profile updated successfully!');
    }
} 