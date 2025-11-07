@extends('layouts.storefront')

@section('content')
    <div class="alumni-directory-container">
        <div class="alumni-directory-header">
            <h1>Alumni Directory</h1>
            <p>Find and connect with fellow alumni.</p>
        </div>

        <div class="filter-bar">
            <form action="{{ route('alumni.index') }}" method="GET">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by name...">
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <select id="department" name="department">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select id="city" name="city">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <select id="blood_group" name="blood_group">
                        <option value="">All Groups</option>
                        @foreach($blood_groups as $blood_group)
                            <option value="{{ $blood_group }}" {{ request('blood_group') == $blood_group ? 'selected' : '' }}>
                                {{ $blood_group }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-buttons">
                    <button type="submit">Filter</button>
                    <a href="{{ route('alumni.index') }}" class="clear-button">Clear</a>
                </div>
            </form>
        </div>

        <div class="alumni-grid">
            @forelse($users as $user)
                <div class="alumni-card">
                    <!-- Upper Part -->
                    <div class="card-part upper-part">
                        <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.svg') }}" alt="{{ $user->name }}" class="profile-photo">
                        <div class="alumni-basic-info">
                            <h3 class="alumni-name">
                                @if($user->first_name && $user->last_name)
                                    {{ $user->first_name }} {{ $user->last_name }}
                                @else
                                    {{ $user->name }}
                                @endif
                            </h3>
                            <p class="alumni-department">{{ $user->department }}</p>
                            <div class="alumni-socials">
                                <a href="#" aria-label="LinkedIn Profile"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#" aria-label="Facebook Profile"><i class="fa-brands fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Middle Part -->
                    <div class="card-part middle-part">
                        @if($user->phone_number)
                            <div class="middle-item">
                                <i class="fa-solid fa-phone"></i>
                                <span>{{ $user->phone_number }}</span>
                            </div>
                        @endif
                        @if($user->email)
                            <div class="middle-item">
                                <i class="fa-solid fa-envelope"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Lower Part -->
                    <div class="card-part lower-part">
                        @if($user->works_at)
                            <div class="lower-item">
                                <i class="fa-solid fa-briefcase"></i>
                                <span>{{ $user->works_at }}</span>
                            </div>
                        @endif
                        @if($user->current_city)
                            <div class="lower-item">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ $user->current_city }}</span>
                            </div>
                        @endif
                        @if($user->blood_group)
                            <div class="lower-item">
                                <i class="fa-solid fa-droplet"></i>
                                <span>{{ $user->blood_group }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p>No alumni found matching your criteria.</p>
            @endforelse
        </div>

        <div class="pagination-links">
            {{ $users->links() }}
        </div>
    </div>
@endsection
