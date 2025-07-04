<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Updated - Bhaktinama</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="bhaktinama-header">
        <img src="{{ asset('images/bhaktinama_logo-removebg-preview.png') }}" alt="Bhaktinama Logo" height="40" style="vertical-align:middle;">
        <i class="fas fa-om bhaktinama-om-icon"></i>
        <span class="bhaktinama-title">Bhaktinama.com</span>
    </div>

    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Profile Updated Successfully!</h1>
            <div class="profile-summary">
                <h3>Updated Information:</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <strong>Name:</strong> {{ auth()->user()->name }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <strong>Phone:</strong> {{ auth()->user()->panditDetail->phone }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Location:</strong> {{ auth()->user()->panditDetail->city }}, {{ auth()->user()->panditDetail->state }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-graduation-cap"></i>
                        <strong>Experience:</strong> {{ auth()->user()->panditDetail->experience_years }} years
                    </div>
                    <div class="info-item">
                        <i class="fas fa-pray"></i>
                        <strong>Specializations:</strong>
                        @php
                            $specs = json_decode(auth()->user()->panditDetail->specialization) ?? [];
                            echo implode(', ', array_map(function($spec) {
                                return ucwords(str_replace('_', ' ', $spec));
                            }, $specs));
                        @endphp
                    </div>
                    <div class="info-item">
                        <i class="fas fa-language"></i>
                        <strong>Languages:</strong>
                        @php
                            $langs = json_decode(auth()->user()->panditDetail->languages_known) ?? [];
                            echo implode(', ', array_map('ucfirst', $langs));
                        @endphp
                    </div>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('pandit.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                </a>
                <a href="{{ route('pandit.profile.edit') }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i> Edit Profile Again
                </a>
            </div>
        </div>
    </div>

    <style>
    .success-container {
        min-height: 100vh;
        background-color: #f8f9fa;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        max-width: 800px;
        width: 100%;
        text-align: center;
    }

    .success-icon {
        font-size: 4rem;
        color: #28a745;
        margin-bottom: 1rem;
    }

    .success-card h1 {
        color: #333;
        margin-bottom: 2rem;
    }

    .profile-summary {
        text-align: left;
        margin: 2rem 0;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .info-item {
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .info-item i {
        color: #FF8C42;
        margin-right: 0.5rem;
    }

    .action-buttons {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #FF8C42;
        color: white;
        border: none;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        border: none;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 1.5rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    </style>
</body>
</html> 