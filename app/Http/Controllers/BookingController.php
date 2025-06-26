<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the user's bookings.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Auto-update status for past bookings
        foreach ($user->bookings()->where('status', 'Reserved')->get() as $booking) {
            $bookingDateTime = Carbon::parse($booking->booking_date . ' ' . $booking->booking_time);
            if ($bookingDateTime->isPast()) {
                $booking->update(['status' => 'Completed']);
            }
        }

        $bookings = $user->bookings()->with('feedback')->latest()->get();
        return view('history', compact('bookings'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'puja_type' => 'required|string|max:255',
            'pandit_name' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Auth::user()->bookings()->create($request->all());

        return redirect()->route('home')->with('success', 'Your puja has been booked successfully!');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        // Authorize that the user owns the booking
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()->route('history')->with('success', 'Booking canceled successfully!');
    }
}
