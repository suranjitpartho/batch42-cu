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

                <div class="profile-details-grid">
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
                    @if($user->current_city)
                        <div class="detail-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ $user->current_city }}{{ $user->country ? ', ' . $user->country : '' }}</span>
                        </div>
                    @endif
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
                </div>

                <div class="profile-divider"></div>

                <div class="profile-socials">
                    <a href="#" aria-label="LinkedIn Profile"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" aria-label="Facebook Profile"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
