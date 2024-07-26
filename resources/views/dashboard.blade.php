@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Dashboard', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
<style>
    .dashboard-background {
        background-color: #f0f8ff;
        background-image: 
            radial-gradient(#ffffff 15%, transparent 16%),
            radial-gradient(#ffffff 15%, transparent 16%);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dashboard-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.3);
        background-blend-mode: overlay;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .card-text {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.8;
        transition: all 0.3s ease;
    }
    .dashboard-card:hover .card-icon {
        transform: scale(1.1);
        opacity: 1;
    }
    .math-symbol {
        position: absolute;
        opacity: 0.1;
        font-size: 5rem;
        font-weight: bold;
        color: #000;
        z-index: 0;
        transition: all 0.3s ease;
    }
    .dashboard-card:hover .math-symbol {
        transform: rotate(15deg);
        opacity: 0.15;
    }
    .row {
        margin-bottom: 2rem;
    }

    /* Styles for sliding pictures */
    .sliding-pictures {
        overflow: hidden;
        white-space: nowrap;
        margin-top: 2rem;
    }
    .sliding-pictures img {
        display: inline-block;
        height: 200px;
        margin-right: 15px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        animation: slide 30s linear infinite;
    }
    @keyframes slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }
</style>

@php
    $acceptedPupilsCount = DB::table('accepted_pupils')->count();
    $rejectedPupilsCount = DB::table('rejected_pupils')->count();
    $challengesCount = DB::table('challenges')->count();
    $schoolsCount = DB::table('schools')->count();
    $incompleteChallengesCount = DB::table('attempt_questions')
        ->select('username')
        ->where('questionsAttempted', '<', 10)
        ->groupBy('username')
        ->get()
        ->count();
    $topPerformingSchoolsCount = DB::table('attempts')
        ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
        ->select('schools.name', DB::raw('count(*) as count'))
        ->where('attempts.score', '>=', 15)
        ->groupBy('schools.name')
        ->havingRaw('count >= 2')
        ->count();
@endphp

<div class="dashboard-background">
    <div class="container-fluid">
        <div class="row">
            <!-- Accepted pupils -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(110,142,251,0.9), rgba(167,119,227,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 10px; left: 10px;">+</span>
                        <i class="fas fa-user-plus card-icon"></i>
                        <h3 class="card-title">Accepted pupils</h3>
                        <p class="card-text">{{ $acceptedPupilsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Rejected pupils -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(17,153,142,0.9), rgba(56,239,125,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 10px; right: 10px;">Σ</span>
                        <i class="fas fa-users card-icon"></i>
                        <h3 class="card-title">Rejected pupils</h3>
                        <p class="card-text">{{ $rejectedPupilsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Available Challenges -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(255,154,158,0.9), rgba(250,208,196,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; left: 10px;">∞</span>
                        <i class="fas fa-trophy card-icon"></i>
                        <h3 class="card-title">Available Challenges</h3>
                        <p class="card-text">{{ $challengesCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Total Schools -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(102,126,234,0.9), rgba(118,75,162,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="bottom: 10px; right: 10px;">π</span>
                        <i class="fas fa-school card-icon"></i>
                        <h3 class="card-title">Total Schools</h3>
                        <p class="card-text">{{ $schoolsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Incomplete Challenges -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(246,211,101,0.9), rgba(253,160,133,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 50%; left: 10px; transform: translateY(-50%);">Δ</span>
                        <i class="fas fa-exclamation-circle card-icon"></i>
                        <h3 class="card-title">Incomplete Challenges</h3>
                        <p class="card-text">{{ $incompleteChallengesCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Top Performing Schools -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(94,231,223,0.9), rgba(180,144,202,0.9)), url('path_to_subtle_pattern.png'); height: 200px;">
                    <div class="card-body text-center text-white d-flex flex-column justify-content-center position-relative">
                        <span class="math-symbol" style="top: 50%; right: 10px; transform: translateY(-50%);">√</span>
                        <i class="fas fa-star card-icon"></i>
                        <h3 class="card-title">Top Performing Schools</h3>
                        <p class="card-text">{{ $topPerformingSchoolsCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="sliding-pictures">
            <img src="image/c.jpeg">
            <img src="image/a.jpeg">
            <img src="image/ssss.jpg">
            <img src="image/m.jpg">
            <img src="image/k.jpeg">
            <img src="image/b.jpeg">
            
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
@endpush