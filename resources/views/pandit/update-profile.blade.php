<link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
            <!-- <img src="{{ asset('images/WhatsApp Image 2025-05-28 at 22.20.33_b3f6ad17.jpg') }}" alt="Logo"> -->
            <div class="bhaktinama-header">
                <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;">
                <i class="fas fa-om bhaktinama-om-icon"></i>
                <span class="bhaktinama-title">Bhaktinama.com</span>
            </div>
            

<div class="profile-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <div class="profile-header">
                        <h2 class="text-center mb-4">
                            <i class="fas fa-user-edit"></i> Update Your Profile
                        </h2>
                        <p class="text-center text-muted">Complete your profile to start accepting puja bookings</p>
                    </div>

                    <form method="POST" action="{{ route('pandit.profile.update') }}" enctype="multipart/form-data" class="profile-form">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture -->
                        <div class="profile-picture-section text-center mb-4">
                            <div class="profile-picture-wrapper">
                                <img id="profile-preview" src="{{ auth()->user()->profile_picture ?? asset('images/default-avatar.png') }}" alt="Profile Picture">
                                <div class="upload-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/*">
                            <label for="profile_picture" class="btn btn-outline-primary mt-2">
                                <i class="fas fa-upload"></i> Upload Photo
                            </label>
                        </div>

                        <!-- Personal Information -->
                        <div class="form-section">
                            <h3 class="section-title">Personal Information</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', auth()->user()->dob) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="experience">Years of Experience</label>
                                    <input type="number" class="form-control" id="experience" name="experience" value="{{ old('experience', auth()->user()->experience) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="form-section">
                            <h3 class="section-title">Professional Information</h3>
                            
                            <div class="mb-4">
                                <label class="d-block mb-3">Specializations</label>
                                <div class="specialization-options">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_satyanarayan" name="specialization[]" value="satyanarayan" {{ in_array('satyanarayan', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_satyanarayan">Satyanarayan Puja</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_griha_pravesh" name="specialization[]" value="griha_pravesh" {{ in_array('griha_pravesh', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_griha_pravesh">Griha Pravesh</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_marriage" name="specialization[]" value="marriage" {{ in_array('marriage', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_marriage">Marriage Ceremony</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_rudrabhishek" name="specialization[]" value="rudrabhishek" {{ in_array('rudrabhishek', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_rudrabhishek">Rudrabhishek</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_lakshmi_puja" name="specialization[]" value="lakshmi_puja" {{ in_array('lakshmi_puja', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_lakshmi_puja">Lakshmi Puja</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_ganesh_puja" name="specialization[]" value="ganesh_puja" {{ in_array('ganesh_puja', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_ganesh_puja">Ganesh Puja</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_navagraha" name="specialization[]" value="navagraha" {{ in_array('navagraha', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_navagraha">Navagraha Puja</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="specialization_kaal_sarp" name="specialization[]" value="kaal_sarp" {{ in_array('kaal_sarp', old('specialization', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="specialization_kaal_sarp">Kaal Sarp Dosh Nivaran</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('specialization')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="d-block mb-3">Languages Spoken</label>
                                <div class="language-options">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_hindi" name="languages[]" value="hindi" {{ in_array('hindi', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_hindi">Hindi</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_sanskrit" name="languages[]" value="sanskrit" {{ in_array('sanskrit', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_sanskrit">Sanskrit</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_english" name="languages[]" value="english" {{ in_array('english', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_english">English</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_marathi" name="languages[]" value="marathi" {{ in_array('marathi', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_marathi">Marathi</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_gujarati" name="languages[]" value="gujarati" {{ in_array('gujarati', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_gujarati">Gujarati</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="language_bengali" name="languages[]" value="bengali" {{ in_array('bengali', old('languages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="language_bengali">Bengali</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('languages')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio">About Yourself</label>
                                <textarea class="form-control" id="bio" name="bio" rows="4" required>{{ old('bio', auth()->user()->bio) }}</textarea>
                                <small class="text-muted">Tell us about your experience, expertise, and approach to conducting pujas.</small>
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="form-section">
                            <h3 class="section-title">Location & Availability</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', auth()->user()->city) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', auth()->user()->state) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Full Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', auth()->user()->address) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="travel_distance">Maximum Travel Distance (in km)</label>
                                <input type="number" class="form-control" id="travel_distance" name="travel_distance" value="{{ old('travel_distance', auth()->user()->travel_distance) }}" required>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="form-section">
                            <h3 class="section-title">Verification Documents</h3>
                            
                            <div class="mb-3">
                                <label for="id_proof">Government ID Proof</label>
                                <input type="file" class="form-control" id="id_proof" name="id_proof" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Upload Aadhar Card, PAN Card, or Voter ID (PDF or Image)</small>
                            </div>

                            <div class="mb-3">
                                <label for="certificates">Certificates/Degrees</label>
                                <input type="file" class="form-control" id="certificates" name="certificates[]" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                <small class="text-muted">Upload your religious education certificates or degrees</small>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-save"></i> Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.profile-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.profile-header {
    margin-bottom: 2rem;
}

.profile-header h2 {
    color: #333;
    font-weight: 600;
}

.profile-picture-section {
    margin-bottom: 2rem;
}

.profile-picture-wrapper {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    cursor: pointer;
}

.profile-picture-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.upload-overlay i {
    color: white;
    font-size: 2rem;
}

.profile-picture-wrapper:hover .upload-overlay {
    opacity: 1;
}

.form-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #FF8C42;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 0.75rem;
}

.form-control:focus {
    border-color: #FF8C42;
    box-shadow: 0 0 0 0.2rem rgba(255,140,66,0.25);
}

.select2-container--default .select2-selection--multiple {
    border-radius: 8px;
    border: 1px solid #ced4da;
    min-height: 100px;
}

.form-actions {
    margin-top: 2rem;
}

.btn-primary {
    background: linear-gradient(135deg, #FF8C42, #FF3C38);
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255,140,66,0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-card {
        padding: 1rem;
    }

    .form-section {
        padding: 1rem;
    }
}

/* Checkbox styles */
.specialization-options,
.language-options {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    border: 1px solid #e0e0e0;
}

.form-check {
    padding-left: 2rem;
}

.form-check-input {
    width: 1.2rem;
    height: 1.2rem;
    margin-top: 0.2rem;
    margin-left: -2rem;
    border: 2px solid #FF8C42;
    border-radius: 3px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #FF8C42;
    border-color: #FF8C42;
}

.form-check-label {
    cursor: pointer;
    font-size: 0.95rem;
    padding-top: 0.1rem;
}

.form-check:hover .form-check-input:not(:checked) {
    border-color: #FF8C42;
    background-color: rgba(255, 140, 66, 0.1);
}

/* Error message styles */
.text-danger {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Section spacing */
.mb-4 {
    margin-bottom: 2rem !important;
}
</style>

<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'classic',
        placeholder: 'Select options',
        width: '100%'
    });

    // Profile Picture Preview
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
