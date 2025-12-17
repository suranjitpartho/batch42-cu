@extends('layouts.storefront')

@section('content')
    <div class="membership-container">
        <h1 class="membership-title">Alumni Membership Application</h1>

        <form action="{{ route('membership.store') }}" method="POST" class="membership-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}" {{ auth()->user()->first_name ? 'readonly' : '' }} required>
                @error('first_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}" {{ auth()->user()->last_name ? 'readonly' : '' }} required>
                @error('last_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', auth()->user()->phone_number) }}" {{ auth()->user()->phone_number ? 'readonly' : '' }} required>
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div x-data="{
                faculties: {{ json_encode($faculties) }},
                selectedFaculty: '{{ old('faculty', auth()->user()->faculty) }}',
                selectedDepartment: '{{ old('department', auth()->user()->department) }}',
                departments: []
            }" x-init="
                if (selectedFaculty && faculties[selectedFaculty]) {
                    departments = faculties[selectedFaculty];
                }
                $watch('selectedFaculty', value => {
                    departments = faculties[value] || [];
                    selectedDepartment = '';
                });
            ">
                <div class="form-group">
                    <label for="faculty" class="form-label">Faculty</label>
                    <select name="faculty" id="faculty" class="form-control" x-model="selectedFaculty" required {{ auth()->user()->faculty ? 'disabled' : '' }}>
                        <option value="">Select Faculty</option>
                        <template x-for="(deptList, facultyName) in faculties" :key="facultyName">
                            <option :value="facultyName" x-text="facultyName" :selected="selectedFaculty === facultyName"></option>
                        </template>
                    </select>
                    @if(auth()->user()->faculty)
                        <input type="hidden" name="faculty" value="{{ auth()->user()->faculty }}">
                    @endif
                    @error('faculty')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="department" class="form-label">Department</label>
                    <select name="department" id="department" class="form-control" x-model="selectedDepartment" required {{ auth()->user()->department ? 'disabled' : '' }}>
                        <option value="">Select Department</option>
                        <template x-for="dept in departments" :key="dept">
                            <option :value="dept" x-text="dept" :selected="selectedDepartment === dept"></option>
                        </template>
                    </select>
                    @if(auth()->user()->department)
                        <input type="hidden" name="department" value="{{ auth()->user()->department }}">
                    @endif
                    @error('department')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="photo" class="form-label">Profile Photo</label>
                @if(auth()->user()->profile_photo_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Current Profile Photo" class="w-20 h-20 rounded-full object-cover">
                        <p class="text-sm text-gray-500 mt-1">Current photo will be used.</p>
                    </div>
                @else
                    <input type="file" name="photo" id="photo" class="form-control file-input" accept="image/*" required>
                    <p class="text-sm text-gray-500 mt-1">Accepted format: Image (Max size: 1MB)</p>
                    @error('photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <label for="certificate" class="form-label">
                    Certificate (PDF or Image) 
                    <span class="text-sm text-gray-600 font-normal">- Upload your university certificate</span>
                </label>
                <input type="file" name="certificate" id="certificate" class="form-control file-input" accept=".pdf,image/jpeg,image/png,image/jpg" required>
                <p class="text-sm text-gray-500 mt-1">Accepted format: PDF, JPEG, PNG (Max size: 1MB)</p>
                @error('certificate')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Submit Application</button>
        </form>
    </div>
@endsection