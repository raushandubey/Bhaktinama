@extends('layouts.app')

@section('title', 'Confirm Appointment – Bhaktinama.com')

@section('content')
<main>
    <div class="progress-bar">
        <div class="step completed"><i class="fa fa-calendar"></i><span>Schedule</span></div>
        <div class="step completed"><i class="fa fa-user-tie"></i><span>Pandit</span></div>
        <div class="step active"><i class="fa fa-check-circle"></i><span>Confirm</span></div>
    </div>
    <div class="form-card animate-card" style="margin-top:2rem;">
        <h2 class="page-title"><i class="fa fa-check-circle"></i> Appointment Confirmation</h2>
        
        <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div id="appointmentDetails">
                {{-- Details will be populated by JavaScript --}}
            </div>

            <input type="hidden" id="puja_type" name="puja_type" value="">
            <input type="hidden" id="pandit_name" name="pandit_name" value="">
            <input type="hidden" id="booking_date" name="booking_date" value="">
            <input type="hidden" id="booking_time" name="booking_time" value="">

            <button id="confirmBookingBtn" type="submit" class="cta-btn">Confirm & Book</button>
        </form>
    </div>
</main>
@endsection 