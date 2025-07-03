@extends('layouts.app')

@section('title', 'My Bookings – Bhaktinama.com')

@section('content')
<main>
    <h2 class="page-title"><i class="fa fa-calendar-check"></i> My Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="bookings-list">
        @forelse($bookings as $booking)
            <div class="booking-card animate-on-scroll" data-animation="animate-slide-up">
                <!-- <div class="booking-header">
                    <span class="booking-id">ID: {{ $booking->id }}</span>
                    <span class="booking-status status-{{ strtolower($booking->status) }}">{{ $booking->status }}</span>
                </div> -->
                <div class="booking-body">
                    <p class="booking-puja"><strong>Puja:</strong> {{ $booking->puja_type }}</p>
                    <p class="booking-pandit"><i class="fa fa-user-tie"></i> {{ $booking->pandit_name }}</p>
                    <p class="booking-date">
                        <i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, M j, Y') }} 
                        <i class="fa fa-clock"></i> {{ $booking->start_time }}
                        @if($booking->end_time)
                            - {{ $booking->end_time }}
                        @endif
                    </p>
                    @if($booking->status == 'Reserved')
                        <div class="countdown-timer" data-booking-datetime="{{ \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->start_time)->toIso8601String() }}">
                            <!-- Countdown will be rendered here by JavaScript -->
                        </div>
                    @endif
                    <p class="booking-user"><strong>User:</strong> {{ $booking->user->name }} | <i class="fa fa-phone"></i> {{ $booking->user->mobile }} | <i class="fa fa-envelope"></i> {{ $booking->user->email }}</p>
                    <p class="booking-pandit-details">
                        <strong>Pandit Details:</strong><br>
                        Name: {{ $booking->pandit_name }}<br>
                        Quality: {{ $booking->pandit_quality ?? '-' }}<br>
                        Rating: {{ $booking->pandit_rating ?? '-' }}<br>
                        Phone: {{ $booking->pandit_phone ?? '-' }}
                    </p>
                </div>
                <div class="booking-footer">
                    @if($booking->feedback)
                        <div class="feedback-display">
                            <p><strong>Your Rating:</strong>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $booking->feedback->rating ? 'rated' : '' }}"></i>
                                @endfor
                            </p>
                            @if($booking->feedback->comment)
                                <p><em>"{{ $booking->feedback->comment }}"</em></p>
                            @endif
                        </div>
                        <button class="cta-btn feedback-btn edit-feedback-btn"
                            data-booking-id="{{ $booking->id }}"
                            data-feedback-id="{{ $booking->feedback->id }}"
                            data-rating="{{ $booking->feedback->rating }}"
                            data-comment="{{ $booking->feedback->comment }}">
                            Edit Feedback
                        </button>
                    @else
                        <button class="cta-btn feedback-btn" data-booking-id="{{ $booking->id }}">Leave Feedback</button>
                    @endif

                    @if($booking->status == 'Reserved')
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cta-btn delete-btn">Cancel Booking</button>
                    </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="info-card">
                <p>You have no bookings yet. Book your first Puja today!</p>
                <a href="{{ route('home') }}" class="cta-btn">Book a Puja</a>
            </div>
        @endforelse
    </div>
</main>

<!-- Feedback Modal -->
<div id="feedbackModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Leave Feedback</h3>
        <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" id="modal_booking_id">
            <input type="hidden" id="modal_feedback_id" value="">
            <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa fa-star" data-rating="{{ $i }}"></i>
                @endfor
            </div>
            <input type="hidden" name="rating" id="modal_rating" value="">
            <textarea name="comment" id="modal_comment" placeholder="Share your experience... (optional)"></textarea>
            <button type="submit" class="cta-btn" id="feedbackSubmitBtn">Submit Feedback</button>
        </form>
    </div>
</div>
@endsection 