<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $booking = Booking::where('id', $request->booking_id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        if ($booking->feedback) {
            return back()->with('error', 'Feedback has already been submitted for this booking.');
        }

        $booking->feedback()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Calculate new average rating for this pandit
        $panditName = $booking->pandit_name;
        $panditBookingIds = Booking::where('pandit_name', $panditName)->pluck('id');
        $avgRating = Feedback::whereIn('booking_id', $panditBookingIds)->avg('rating');
        // Update all bookings for this pandit with the new average
        Booking::where('pandit_name', $panditName)->update(['pandit_rating' => $avgRating]);

        return redirect()->route('history')->with('success', 'Thank you for your feedback!');
    }

    /**
     * Update an existing feedback in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $feedback = Feedback::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $feedback->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Recalculate average rating for the pandit
        $booking = $feedback->booking;
        $panditName = $booking->pandit_name;
        $panditBookingIds = Booking::where('pandit_name', $panditName)->pluck('id');
        $avgRating = Feedback::whereIn('booking_id', $panditBookingIds)->avg('rating');
        Booking::where('pandit_name', $panditName)->update(['pandit_rating' => $avgRating]);

        return redirect()->route('history')->with('success', 'Your feedback has been updated!');
    }
}
