<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PanditMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'pandit') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Check if the user needs to complete their profile
        // Skip this check for the profile update route itself
        if (!auth()->user()->profile_completed && 
            !$request->routeIs('pandit.profile.edit') && 
            !$request->routeIs('pandit.profile.update')) {
            return redirect()->route('pandit.profile.edit')
                ->with('warning', 'Please complete your profile to access the dashboard.');
        }

        return $next($request);
    }
} 