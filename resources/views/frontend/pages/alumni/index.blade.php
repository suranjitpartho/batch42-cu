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

                <div x-data="{
                    faculties: {{ json_encode($facultiesConfig) }},
                    selectedFaculty: '{{ request('faculty') }}',
                    selectedDepartment: '{{ request('department') }}',
                    departments: []
                }" x-init="
                    if (selectedFaculty && faculties[selectedFaculty]) {
                        departments = faculties[selectedFaculty];
                    }
                    $watch('selectedFaculty', value => {
                        departments = faculties[value] || [];
                        selectedDepartment = '';
                    });
                " style="display: contents;">
                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <select id="faculty" name="faculty" x-model="selectedFaculty">
                            <option value="">All Faculties</option>
                            <template x-for="(deptList, facultyName) in faculties" :key="facultyName">
                                <option :value="facultyName" x-text="facultyName" :selected="selectedFaculty === facultyName"></option>
                            </template>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" x-model="selectedDepartment">
                            <option value="">All Departments</option>
                            <template x-for="dept in departments" :key="dept">
                                <option :value="dept" x-text="dept" :selected="selectedDepartment === dept"></option>
                            </template>
                        </select>
                    </div>
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
                    <a href="{{ route('alumni.show', $user) }}" class="card-cover-link"></a>
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
                            <p class="alumni-department">
                                {{ $user->department }}
                                @if($user->blood_group)
                                    <span class="blood-group">
                                        <i class="fa-solid fa-droplet"></i>
                                        {{ $user->blood_group }}
                                    </span>
                                @endif
                            </p>
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
                </div>
            @empty
                <p>No alumni found matching your criteria.</p>
            @endforelse
        </div>

        <div class="frontend-pagination-container">
            {{ $users->links() }}
        </div>
    </div>
@endsection
