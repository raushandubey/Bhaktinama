// main.js

document.addEventListener('DOMContentLoaded', function() {
    // Puja selection from homepage
    const pujaGrid = document.querySelector('.puja-grid');
    if (pujaGrid) {
        pujaGrid.addEventListener('click', function(e) {
            const button = e.target.closest('a.cta-btn');
            if (button) {
                e.preventDefault();
                const card = button.closest('.puja-card');
                if (card) {
                    const pujaName = card.querySelector('h3').textContent;
                    localStorage.setItem('bhakti_puja', pujaName);
                    // Redirect to schedule page for booking
                    window.location.href = '/schedule';
                }
            }
        });
    }

    // Schedule page: date picker and time slots
    const timeSlotsDiv = document.getElementById('timeSlots');
    const datePicker = document.getElementById('datePicker');
    if (timeSlotsDiv && datePicker) {
        const slots = [
            '5:00 AM', '5:30 AM', '6:00 AM', '6:30 AM',
            '7:00 AM', '7:30 AM', '8:00 AM', '8:30 AM',
            '9:00 AM', '9:30 AM'
        ];
        function renderSlots() {
            timeSlotsDiv.innerHTML = '';
            slots.forEach((slot, i) => {
                // Dummy: every even slot is available
                const available = i % 2 === 0;
                const div = document.createElement('div');
                div.className = 'time-slot ' + (available ? 'available' : 'unavailable');
                div.textContent = slot + (available ? ' ✅' : ' ❌');
                if (available) {
                    div.addEventListener('click', () => {
                        localStorage.setItem('bhakti_slot', JSON.stringify({ date: datePicker.value, slot }));
                        window.location.href = '/pandit';
                    });
                }
                timeSlotsDiv.appendChild(div);
            });
        }
        datePicker.addEventListener('change', renderSlots);
    }

    // Pandit selection as cards with modal
    const panditCardsDiv = document.getElementById('panditCards');
    const panditForm = document.getElementById('panditForm');
    const panditModal = document.getElementById('panditModal');
    const modalDetails = document.getElementById('modalDetails');
    if (panditCardsDiv && panditForm) {
        const pandits = [
            { name: 'Pandit Ram Sharma', dob: '1970-01-01', reviews: 4.8, profile: 'Expert in Vedic rituals', img: 'assets/images/pandit1.jpg', bio: '25+ years of experience in Vedic rituals, pujas, and astrology.' },
            { name: 'Pandit Suresh Joshi', dob: '1980-05-12', reviews: 4.6, profile: 'Specialist in Puja ceremonies', img: 'assets/images/pandit2.jpg', bio: 'Known for his devotion and expertise in all major pujas and havans.' },
            { name: 'Pandit Anil Mishra', dob: '1975-09-23', reviews: 4.9, profile: 'Astrology & Rituals', img: 'assets/images/pandit3.jpg', bio: 'Astrology expert and ritual specialist, highly rated by devotees.' },
             { name: 'Pandit Raushan Dubey', dob: '1975-01-09', reviews: 4.9, profile: 'Astrology & Rituals', img: 'images/WhatsApp Image 2025-06-20 at 13.41.28_3b45c108.jpg', bio: 'Astrology expert and ritual specialist, highly rated by devotees.' },
        ];
        panditCardsDiv.innerHTML = pandits.map((p, i) => `
            <div class="pandit-card">
                <img src="${p.img}" alt="${p.name}">
                <div class="pandit-name">${p.name}</div>
                <div class="pandit-profile">${p.profile}</div>
                <div class="pandit-dob">DOB: ${p.dob}</div>
                <div class="pandit-reviews">${p.reviews} <i class="fa fa-star"></i></div>
                <input type="radio" name="pandit" value="${i}" required>
                <button type="button" class="view-details-btn" data-idx="${i}">View Details</button>
            </div>
        `).join('');
        // Modal logic
        panditCardsDiv.addEventListener('click', function(e) {
            if (e.target.classList.contains('view-details-btn')) {
                const idx = e.target.getAttribute('data-idx');
                const p = pandits[idx];
                modalDetails.innerHTML = `
                    <img src="${p.img}" alt="${p.name}" style="width:100px;height:100px;border-radius:50%;margin-bottom:1rem;">
                    <h3>${p.name}</h3>
                    <p><strong>Profile:</strong> ${p.profile}</p>
                    <p><strong>DOB:</strong> ${p.dob}</p>
                    <p><strong>Reviews:</strong> ${p.reviews} <i class='fa fa-star'></i></p>
                    <p>${p.bio}</p>
                `;
                panditModal.style.display = 'flex';
            }
        });
        document.querySelector('.close-modal').onclick = function() {
            panditModal.style.display = 'none';
        };
        window.onclick = function(event) {
            if (event.target === panditModal) {
                panditModal.style.display = 'none';
            }
        };
        panditForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const selected = panditForm.pandit.value;
            localStorage.setItem('bhakti_pandit', JSON.stringify(pandits[selected]));
            window.location.href = '/appointment';
        });
    }

    // Appointment details page
    const appointmentDetails = document.getElementById('appointmentDetails');
    const payNowBtn = document.getElementById('payNowBtn');
    const paymentBox = document.getElementById('paymentBox');
    if (appointmentDetails) {
        const slot = JSON.parse(localStorage.getItem('bhakti_slot') || '{}');
        const pandit = JSON.parse(localStorage.getItem('bhakti_pandit') || '{}');
        const puja = localStorage.getItem('bhakti_puja') || 'Not specified';
        const appointmentId = 'BN' + Math.floor(Math.random()*1000000);
        
        // Get user data from the page (if available)
        const userMobile = document.querySelector('[data-user-mobile]')?.getAttribute('data-user-mobile') || 
                          localStorage.getItem('bhakti_user_mobile') || 'Not available';
        const userName = document.querySelector('[data-user-name]')?.getAttribute('data-user-name') || 
                        localStorage.getItem('bhakti_user_name') || 'Not available';
        
        appointmentDetails.innerHTML = `
            <h2>Appointment ID: ${appointmentId}</h2>
            <p><strong>Puja Type:</strong> ${puja}</p>
            <p><strong>Date:</strong> ${slot.date || '-'}</p>
            <p><strong>Time Slot:</strong> ${slot.slot || '-'}</p>
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> ${userName}</p>
            <p><strong>Mobile:</strong> ${userMobile}</p>
            <h3>Pandit Details</h3>
            <p><strong>Name:</strong> ${pandit.name || '-'}</p>
            <p><strong>Profile:</strong> ${pandit.profile || '-'}</p>
            <p><strong>Reviews:</strong> ${pandit.reviews || '-'}</p>
            <p><strong>Status:</strong> Reserved</p>
        `;
        if (payNowBtn && paymentBox) {
            payNowBtn.addEventListener('click', function() {
                paymentBox.style.display = 'block';
                payNowBtn.style.display = 'none';
                // Save booking to localStorage
                const bookings = JSON.parse(localStorage.getItem('bhakti_bookings') || '[]');
                bookings.push({
                    id: appointmentId,
                    date: slot.date,
                    slot: slot.slot,
                    puja: puja,
                    userName: userName,
                    userMobile: userMobile,
                    pandit,
                    status: 'Reserved'
                });
                localStorage.setItem('bhakti_bookings', JSON.stringify(bookings));
            });
        }
    }

    // My Bookings (history.html)
    const bookingsList = document.getElementById('bookingsList');
    const bookingModal = document.getElementById('bookingModal');
    const modalBookingDetails = document.getElementById('modalBookingDetails');
    if (bookingsList) {
        const bookings = JSON.parse(localStorage.getItem('bhakti_bookings') || '[]');
        if (bookings.length === 0) {
            bookingsList.innerHTML = '<p style="text-align:center;color:#888;">No bookings found. Book your first Pandit now!</p>';
        } else {
            bookingsList.innerHTML = bookings.map((b, idx) => `
                <div class="booking-card">
                    <div class="booking-id">${b.id}</div>
                    <div class="booking-puja"><strong>Puja:</strong> ${b.puja || 'General Booking'}</div>
                    <div class="booking-date"><i class="fa fa-calendar"></i> ${b.date} &nbsp; <i class="fa fa-clock"></i> ${b.slot}</div>
                    <div class="booking-pandit"><i class="fa fa-user-tie"></i> ${b.pandit.name}</div>
                    <div class="booking-mobile"><i class="fa fa-phone"></i> ${b.userMobile || 'Not available'}</div>
                    <div class="booking-status">${b.status}</div>
                    <button class="view-details-btn" data-idx="${idx}">View Details</button>
                </div>
            `).join('');
            bookingsList.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-details-btn')) {
                    const idx = e.target.getAttribute('data-idx');
                    const b = bookings[idx];
                    modalBookingDetails.innerHTML = `
                        <h3>Booking Details</h3>
                        <p><strong>Appointment ID:</strong> ${b.id}</p>
                        <p><strong>Puja Type:</strong> ${b.puja || 'General Booking'}</p>
                        <p><strong>Date:</strong> ${b.date}</p>
                        <p><strong>Time Slot:</strong> ${b.slot}</p>
                        <h4>Customer Details</h4>
                        <p><strong>Name:</strong> ${b.userName || 'Not available'}</p>
                        <p><strong>Mobile:</strong> ${b.userMobile || 'Not available'}</p>
                        <h4>Pandit Details</h4>
                        <p><strong>Name:</strong> ${b.pandit.name || '-'}</p>
                        <p><strong>Profile:</strong> ${b.pandit.profile || '-'}</p>
                        <p><strong>Reviews:</strong> ${b.pandit.reviews || '-'}</p>
                        <p><strong>Status:</strong> ${b.status}</p>
                    `;
                    bookingModal.style.display = 'flex';
                }
            });
            document.querySelector('.close-modal').onclick = function() {
                bookingModal.style.display = 'none';
            };
            window.onclick = function(event) {
                if (event.target === bookingModal) {
                    bookingModal.style.display = 'none';
                }
            };
        }
    }

    // Scroll animations
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    // Assign random animation classes for variety
    const animationClasses = ['animate-fade', 'animate-scale', 'animate-slide-left', 'animate-slide-right'];
    animatedElements.forEach(el => {
        // Only add if not already present
        if (!animationClasses.some(cls => el.classList.contains(cls))) {
            // Section titles: fade or slide
            if (el.classList.contains('section-title')) {
                el.classList.add(Math.random() > 0.5 ? 'animate-fade' : 'animate-slide-left');
            } else {
                // Cards: random animation
                el.classList.add(animationClasses[Math.floor(Math.random() * animationClasses.length)]);
            }
        }
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Store user data when available
    const userDataElement = document.querySelector('[data-user-mobile]');
    if (userDataElement) {
        const userName = userDataElement.getAttribute('data-user-name');
        const userMobile = userDataElement.getAttribute('data-user-mobile');
        localStorage.setItem('bhakti_user_name', userName);
        localStorage.setItem('bhakti_user_mobile', userMobile);
    }

    // Quick Book functionality for logged-in users
    const quickPujaButtons = document.querySelectorAll('.quick-puja-btn');
    quickPujaButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pujaName = this.getAttribute('data-puja');
            localStorage.setItem('bhakti_puja', pujaName);
            window.location.href = '/schedule';
        });
    });

}); 