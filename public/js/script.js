// main.js

document.addEventListener('DOMContentLoaded', function() {
    // Advanced Scroll animations with data attributes
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    if (animatedElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    
                    // Apply animation specified in data-attribute, or a default
                    const animation = el.dataset.animation || 'animate-fade-in';
                    el.classList.add(animation);

                    // Stagger animations for elements in a list
                    const delay = el.dataset.staggerDelay || 0;
                    setTimeout(() => {
                        el.classList.add('visible');
                    }, delay);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.1 });

        // Group elements and apply delays
        const groups = {};
        animatedElements.forEach(el => {
            const parent = el.parentElement;
            const key = parent.id || parent.className;
            if (!groups[key]) groups[key] = [];
            groups[key].push(el);
        });

        Object.values(groups).forEach(group => {
            group.forEach((el, index) => {
                el.dataset.staggerDelay = index * 120;
                observer.observe(el);
            });
        });
    }

    // Quick Book & Puja Card functionality
    const handlePujaSelection = function(pujaName) {
        localStorage.setItem('bhakti_puja', pujaName);
        window.location.href = '/schedule';
    };
    document.querySelectorAll('.quick-puja-btn').forEach(b => b.addEventListener('click', () => handlePujaSelection(b.dataset.puja)));
    document.querySelectorAll('.puja-card a.cta-btn').forEach(a => a.addEventListener('click', (e) => {
            e.preventDefault();
        handlePujaSelection(a.closest('.puja-card').querySelector('h3').textContent);
    }));

    // Schedule page
    const datePicker = document.getElementById('datePicker');
    const slotsDiv = document.getElementById('timeSlots');
    if (datePicker && slotsDiv) {
        slotsDiv.innerHTML = '<div style="color:#888;text-align:center;">Please select a date to see available time slots.</div>';
        const slots = ['5:00 AM', '6:00 AM', '7:00 AM', '8:00 AM', '9:00 AM', '5:00 PM', '6:00 PM', '7:00 PM'];
        datePicker.addEventListener('change', function() {
            slotsDiv.innerHTML = '';
            slots.forEach(slot => {
                const div = document.createElement('div');
                div.className = 'time-slot available';
                div.textContent = slot;
                    div.addEventListener('click', () => {
                        localStorage.setItem('bhakti_slot', JSON.stringify({ date: datePicker.value, slot }));
                    window.location.href = '/pandit';
                    });
                slotsDiv.appendChild(div);
            });
        });
    }

    // Pandit selection page
    const panditForm = document.getElementById('panditForm');
    const panditCardsDiv = document.getElementById('panditCards');
    if (panditForm && panditCardsDiv) {
        // Example Pandit data (can be replaced with server data)
        const pandits = [
            { name: 'Pandit Ram Sharma', quality: 'Expert in Vedic rituals', rating: 4.8, phone: '9876543210', img: 'images/WhatsApp Image 2025-06-20 at 13.41.28_3b45c108.jpg', bio: '25+ years of experience in Vedic rituals, pujas, and astrology.' },
            { name: 'Pandit Suresh Joshi', quality: 'Specialist in Puja ceremonies', rating: 4.6, phone: '9876543211', img: 'images/Puja.jpg', bio: 'Known for his devotion and expertise in all major pujas and havans.' },
            { name: 'Pandit Anil Mishra', quality: 'Astrology & Rituals', rating: 4.9, phone: '9876543212', img: 'images/Satyanarayan Puja.jpg', bio: 'Astrology expert and ritual specialist, highly rated by devotees.' },
            { name: 'Pandit Raushan Dubey', quality: 'Astrology & Rituals', rating: 4.9, phone: '9876543213', img: 'images/WhatsApp Image 2025-05-28 at 22.20.33_b3f6ad17.jpg', bio: 'Astrology expert and ritual specialist, highly rated by devotees.' },
        ];
        panditCardsDiv.innerHTML = pandits.map((p, i) => `
            <label class="pandit-card">
                <input type="radio" name="pandit" value="${i}" required>
                <img src="${p.img}" alt="${p.name}" class="pandit-img">
                <div class="pandit-info">
                    <div class="pandit-name">${p.name}</div>
                    <div class="pandit-profile">${p.quality}</div>
                    <div class="pandit-reviews">${p.rating} <i class="fa fa-star"></i></div>
                    <div class="pandit-bio">${p.bio}</div>
                    <div class="pandit-phone"><i class="fa fa-phone"></i> ${p.phone}</div>
            </div>
            </label>
        `).join('');
        panditForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedIdx = new FormData(this).get('pandit');
            if (selectedIdx !== null) {
                localStorage.setItem('bhakti_pandit', JSON.stringify(pandits[selectedIdx]));
                window.location.href = '/appointment';
            } else {
                alert('Please select a pandit.');
            }
        });
    }

    // Appointment confirmation page
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        const puja = localStorage.getItem('bhakti_puja') || 'Not specified';
        const slot = JSON.parse(localStorage.getItem('bhakti_slot') || '{}');
        const pandit = JSON.parse(localStorage.getItem('bhakti_pandit') || '{}');

        document.getElementById('puja_type').value = puja;
        document.getElementById('pandit_name').value = pandit.name || pandit;
        document.getElementById('booking_date').value = slot.date;
        document.getElementById('booking_time').value = slot.slot;

        // Set new pandit details fields if present
        if (pandit.quality) {
            let q = document.getElementById('pandit_quality');
            if (!q) {
                q = document.createElement('input');
                q.type = 'hidden';
                q.name = 'pandit_quality';
                q.id = 'pandit_quality';
                bookingForm.appendChild(q);
            }
            q.value = pandit.quality;
        }
        if (pandit.rating) {
            let r = document.getElementById('pandit_rating');
            if (!r) {
                r = document.createElement('input');
                r.type = 'hidden';
                r.name = 'pandit_rating';
                r.id = 'pandit_rating';
                bookingForm.appendChild(r);
            }
            r.value = pandit.rating;
        }
        if (pandit.phone) {
            let p = document.getElementById('pandit_phone');
            if (!p) {
                p = document.createElement('input');
                p.type = 'hidden';
                p.name = 'pandit_phone';
                p.id = 'pandit_phone';
                bookingForm.appendChild(p);
            }
            p.value = pandit.phone;
        }

        document.getElementById('appointmentDetails').innerHTML = `
            <h2>Review Your Booking</h2>
            <p><strong>Puja Type:</strong> ${puja}</p>
            <p><strong>Date & Time:</strong> ${slot.date} at ${slot.slot}</p>
            <p><strong>Pandit:</strong> ${pandit.name || pandit}</p>
        `;
    }
    
    // Countdown Timer for Bookings
    const countdownTimers = document.querySelectorAll('.countdown-timer');
    if (countdownTimers.length > 0) {
        const updateTimers = () => {
            countdownTimers.forEach(timer => {
                const bookingDateTime = new Date(timer.dataset.bookingDatetime).getTime();
                const now = new Date().getTime();
                const distance = bookingDateTime - now;

                if (distance < 0) {
                    timer.innerHTML = "Puja time has started!";
                    // Optionally, reload the page to update status
                    if (!timer.classList.contains('reloaded')) {
                       setTimeout(() => window.location.reload(), 2000);
                       timer.classList.add('reloaded');
                    }
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                timer.innerHTML = `<i class="fa fa-hourglass-start"></i> Starts in: <strong>${days}d ${hours}h ${minutes}m ${seconds}s</strong>`;
            });
        };
        setInterval(updateTimers, 1000);
        updateTimers(); // Initial call
    }
    
    // Feedback Modal
    const feedbackModal = document.getElementById('feedbackModal');
    if (feedbackModal) {
        const feedbackBtns = document.querySelectorAll('.feedback-btn');
        const closeModalBtn = feedbackModal.querySelector('.close-modal');
        const feedbackForm = document.getElementById('feedbackForm');
        const feedbackSubmitBtn = document.getElementById('feedbackSubmitBtn');
        const modalFeedbackId = document.getElementById('modal_feedback_id');
        const modalComment = document.getElementById('modal_comment');

        feedbackBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('modal_booking_id').value = btn.dataset.bookingId;
                // If editing feedback
                if (btn.classList.contains('edit-feedback-btn')) {
                    // Prefill rating and comment
                    const rating = btn.dataset.rating;
                    const comment = btn.dataset.comment || '';
                    modalFeedbackId.value = btn.dataset.feedbackId;
                    modalComment.value = comment;
                    // Set stars
                    const stars = feedbackModal.querySelectorAll('.rating-stars .fa-star');
                    stars.forEach(s => s.classList.toggle('rated', s.dataset.rating <= rating));
                    feedbackModal.querySelector('#modal_rating').value = rating;
                    // Change form action to PATCH
                    feedbackForm.action = `/feedback/${btn.dataset.feedbackId}`;
                    feedbackForm.method = 'post';
                    // Add _method PATCH
                    if (!feedbackForm.querySelector('input[name="_method"]')) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PATCH';
                        feedbackForm.appendChild(methodInput);
                    } else {
                        feedbackForm.querySelector('input[name="_method"]').value = 'PATCH';
                    }
                    feedbackSubmitBtn.textContent = 'Update Feedback';
                } else {
                    // New feedback
                    modalFeedbackId.value = '';
                    modalComment.value = '';
                    feedbackModal.querySelector('#modal_rating').value = '';
                    const stars = feedbackModal.querySelectorAll('.rating-stars .fa-star');
                    stars.forEach(s => s.classList.remove('rated'));
                    feedbackForm.action = '/feedback';
                    feedbackForm.method = 'post';
                    if (feedbackForm.querySelector('input[name="_method"]')) {
                        feedbackForm.querySelector('input[name="_method"]').value = 'POST';
                    }
                    feedbackSubmitBtn.textContent = 'Submit Feedback';
                }
                feedbackModal.style.display = 'flex';
            });
        });

        closeModalBtn.onclick = () => {
            feedbackModal.style.display = 'none';
            // Reset form to POST for new feedback
            feedbackForm.action = '/feedback';
            feedbackForm.method = 'post';
            if (feedbackForm.querySelector('input[name="_method"]')) {
                feedbackForm.querySelector('input[name="_method"]').value = 'POST';
            }
            feedbackSubmitBtn.textContent = 'Submit Feedback';
            modalFeedbackId.value = '';
            modalComment.value = '';
            feedbackModal.querySelector('#modal_rating').value = '';
            const stars = feedbackModal.querySelectorAll('.rating-stars .fa-star');
            stars.forEach(s => s.classList.remove('rated'));
        };
        window.addEventListener('click', (event) => {
            if (event.target == feedbackModal) closeModalBtn.onclick();
        });

        // Star rating
        const stars = feedbackModal.querySelectorAll('.rating-stars .fa-star');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                feedbackModal.querySelector('#modal_rating').value = rating;
                stars.forEach(s => s.classList.toggle('rated', s.dataset.rating <= rating));
            });
        });
    }
}); 