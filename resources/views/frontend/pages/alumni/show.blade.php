@extends('layouts.storefront')

@section('content')
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-banner"></div>
            <div class="profile-picture-wrapper">
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.svg') }}" alt="{{ $user->name }}" class="profile-picture">
            </div>
            <div class="profile-info">
                <h1 class="profile-name">
                    @if($user->first_name && $user->last_name)
                        {{ $user->first_name }} {{ $user->last_name }}
                    @else
                        {{ $user->name }}
                    @endif
                </h1>
                @if($user->department)
                    <p class="profile-department">{{ $user->department }}</p>
                @endif

                <div class="profile-divider"></div>

                @if($user->bio)
                    <p class="profile-bio">{{ $user->bio }}</p>
                    <div class="profile-divider"></div>
                @endif

                <div class="profile-details-grid">
                    <!-- Contact Info -->
                    @if($user->email)
                        <div class="detail-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                    @endif
                    @if($user->phone_number)
                        <div class="detail-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>{{ $user->phone_number }}</span>
                        </div>
                    @endif
                    
                    <!-- Personal Info -->
                    @if($user->blood_group)
                        <div class="detail-item">
                            <i class="fa-solid fa-droplet"></i>
                            <span>{{ $user->blood_group }}</span>
                        </div>
                    @endif
                    @if($user->date_of_birth)
                        <div class="detail-item">
                            <i class="fa-solid fa-cake-candles"></i>
                            <span>{{ $user->date_of_birth->format('jS F Y') }}</span>
                        </div>
                    @endif

                    <!-- Location Info -->
                    @if($user->current_city)
                        <div class="detail-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ $user->current_city }}{{ $user->country ? ', ' . $user->country : '' }}</span>
                        </div>
                    @endif
                    @if($user->home_district)
                        <div class="detail-item">
                            <i class="fa-solid fa-house-user"></i>
                            <span>{{ $user->home_district }} (Home)</span>
                        </div>
                    @endif

                    <!-- Work Info -->
                    @if($user->works_at)
                        <div class="detail-item">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>{{ $user->works_at }}</span>
                        </div>
                    @endif
                    @if($user->designation)
                        <div class="detail-item">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>{{ $user->designation }}</span>
                        </div>
                    @endif
                </div>

                @if($user->hobby)
                    <div class="profile-divider"></div>
                    <div class="profile-hobby">
                        <h3><i class="fa-solid fa-palette"></i> Hobbies & Interests</h3>
                        <p>{{ $user->hobby }}</p>
                    </div>
                @endif

                @if($user->linkedin_url || $user->facebook_url || $user->instagram_url)
                    <div class="profile-divider"></div>

                    <div class="profile-socials">
                        @if($user->linkedin_url)
                            <a href="{{ $user->linkedin_url }}" target="_blank" aria-label="LinkedIn Profile"><i class="fa-brands fa-linkedin"></i></a>
                        @endif
                        @if($user->facebook_url)
                            <a href="{{ $user->facebook_url }}" target="_blank" aria-label="Facebook Profile"><i class="fa-brands fa-facebook"></i></a>
                        @endif
                        @if($user->instagram_url)
                            <a href="{{ $user->instagram_url }}" target="_blank" aria-label="Instagram Profile"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
