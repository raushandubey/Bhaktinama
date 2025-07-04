<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandit Registration – Bhaktinama.com</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <header class="navbar">
        <div class="logo" onclick="window.location.href='/index'" style="cursor:pointer;">
            <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;"> 
            <i class="fas fa-om" style="font-size: 24px; color: #d4af37; margin-right: 10px;"></i>
            <span>Bhaktinama.com</span>
        </div>
        <nav>
            <a href="/index">Home</a>
            <a href="/panditlogin">Pandit Login</a>
        </nav>
    </header>
    <main>
        <div class="form-card animate-card">
            <h2 class="page-title"><i class="fa fa-user-plus"></i> Pandit Registration</h2>
            <p class="info-text">Join our platform to offer your spiritual services and connect with devotees.</p>

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pandit.register') }}" id="panditSignupForm" class="validate-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>
                        Full Name: <span class="required">*</span>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               class="@error('name') is-invalid @enderror"
                               required 
                               placeholder="Your Full Name"
                               pattern="[A-Za-z\s]+"
                               title="Name should only contain letters and spaces">
                    </label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Email: <span class="required">*</span>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               class="@error('email') is-invalid @enderror"
                               required 
                               placeholder="you@email.com">
                    </label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Phone Number: <span class="required">*</span>
                        <input type="tel" 
                               name="phone" 
                               value="{{ old('phone') }}" 
                               class="@error('phone') is-invalid @enderror"
                               required 
                               placeholder="10-digit Mobile Number"
                               pattern="[0-9]{10}"
                               title="Please enter a valid 10-digit mobile number">
                    </label>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Years of Experience: <span class="required">*</span>
                        <input type="number" 
                               name="experience" 
                               value="{{ old('experience') }}" 
                               class="@error('experience') is-invalid @enderror"
                               required 
                               min="0"
                               placeholder="Years of Experience as Pandit">
                    </label>
                    @error('experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Specialization: <span class="required">*</span>
                        <select name="specialization[]" 
                                class="select2 @error('specialization') is-invalid @enderror" 
                                multiple 
                                required>
                            <option value="satyanarayan" {{ in_array('satyanarayan', old('specialization', [])) ? 'selected' : '' }}>Satyanarayan Puja</option>
                            <option value="griha_pravesh" {{ in_array('griha_pravesh', old('specialization', [])) ? 'selected' : '' }}>Griha Pravesh</option>
                            <option value="marriage" {{ in_array('marriage', old('specialization', [])) ? 'selected' : '' }}>Marriage Ceremony</option>
                            <option value="rudrabhishek" {{ in_array('rudrabhishek', old('specialization', [])) ? 'selected' : '' }}>Rudrabhishek</option>
                            <option value="lakshmi_puja" {{ in_array('lakshmi_puja', old('specialization', [])) ? 'selected' : '' }}>Lakshmi Puja</option>
                            <option value="ganesh_puja" {{ in_array('ganesh_puja', old('specialization', [])) ? 'selected' : '' }}>Ganesh Puja</option>
                            <option value="navagraha" {{ in_array('navagraha', old('specialization', [])) ? 'selected' : '' }}>Navagraha Puja</option>
                            <option value="kaal_sarp" {{ in_array('kaal_sarp', old('specialization', [])) ? 'selected' : '' }}>Kaal Sarp Dosh Nivaran</option>
                        </select>
                    </label>
                    @error('specialization')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        About Yourself: <span class="required">*</span>
                        <textarea name="about" 
                                  class="@error('about') is-invalid @enderror"
                                  required 
                                  rows="4"
                                  placeholder="Tell us about your experience, expertise, and approach to conducting pujas">{{ old('about') }}</textarea>
                    </label>
                    @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Password: <span class="required">*</span>
                        <input type="password" 
                               name="password" 
                               class="@error('password') is-invalid @enderror"
                               required 
                               minlength="8"
                               placeholder="Minimum 8 characters"
                               pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$"
                               title="Password must be at least 8 characters long and contain at least one letter and one number">
                    </label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Confirm Password: <span class="required">*</span>
                        <input type="password" 
                               name="password_confirmation" 
                               required 
                               minlength="8"
                               placeholder="Confirm your password">
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        Profile Picture:
                        <input type="file" 
                               name="profile_picture" 
                               class="@error('profile_picture') is-invalid @enderror"
                               accept="image/*">
                        <small class="text-muted">Upload a clear, professional photo of yourself</small>
                    </label>
                    @error('profile_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Certificates/Degrees:
                        <input type="file" 
                               name="certificates[]" 
                               class="@error('certificates') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png"
                               multiple>
                        <small class="text-muted">Upload your religious education certificates or degrees (PDF or images)</small>
                    </label>
                    @error('certificates')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="cta-btn">Register as Pandit</button>
            </form>
            
            <div class="auth-links">
                <p>Already registered? <a href="{{ route('pandit.login') }}">Login here</a></p>   
            </div>
            <div class="auth-links">
                <p>For User Registration <a href="{{ route('signup') }}">click here</a></p>
            </div>
        </div>
    </main>

    <style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .required {
        color: #dc3545;
        margin-left: 2px;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .alert {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0.25rem;
    }
    
    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 1.25rem;
    }
    
    input:invalid, textarea:invalid, select:invalid {
        border-color: #dc3545;
    }
    
    .validate-form input:not(:placeholder-shown):valid,
    .validate-form textarea:not(:placeholder-shown):valid,
    .validate-form select:valid {
        border-color: #28a745;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        min-height: 100px;
        padding: 0.5rem;
    }

    .select2-container--default.is-invalid .select2-selection--multiple {
        border-color: #dc3545;
    }

    .text-muted {
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    /* Additional styles for better form appearance */
    input, select, textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #d4af37;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #d4af37;
        border: none;
        color: white;
        padding: 0.25rem 0.5rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-right: 5px;
    }

    .cta-btn {
        background: linear-gradient(135deg, #d4af37, #aa8c2c);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.25rem;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('panditSignupForm');
        const password = form.querySelector('input[name="password"]');
        const confirmPassword = form.querySelector('input[name="password_confirmation"]');
        
        // Initialize Select2
        $('.select2').select2({
            theme: 'classic',
            placeholder: 'Select your specializations',
            width: '100%'
        }).on('select2:select select2:unselect', function (e) {
            $(this).trigger('change');
            if ($(this).val() && $(this).val().length > 0) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        });
        
        // Real-time password validation
        password.addEventListener('input', function() {
            const isValid = this.checkValidity();
            this.classList.toggle('is-invalid', !isValid);
            if (!isValid) {
                this.reportValidity();
            }
        });
        
        // Real-time password confirmation validation
        confirmPassword.addEventListener('input', function() {
            if (this.value !== password.value) {
                this.setCustomValidity('Passwords do not match');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
            }
        });
        
        // Form submission validation
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                // Show validation messages
                const invalidInputs = form.querySelectorAll(':invalid');
                invalidInputs[0].focus();
            }
        });

        // File input validation
        const profilePicture = form.querySelector('input[name="profile_picture"]');
        profilePicture.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    this.setCustomValidity('Please select an image file');
                    this.classList.add('is-invalid');
                } else if (file.size > 2 * 1024 * 1024) { // 2MB
                    this.setCustomValidity('Image size should not exceed 2MB');
                    this.classList.add('is-invalid');
                } else {
                    this.setCustomValidity('');
                    this.classList.remove('is-invalid');
                }
            }
        });

        // Initialize validation for required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
    </script>
</body>
</html> 