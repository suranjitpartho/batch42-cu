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

            <div class="form-group">
                <label for="department" class="form-label">Department</label>
                <input type="text" name="department" id="department" class="form-control" value="{{ old('department', auth()->user()->department) }}" {{ auth()->user()->department ? 'readonly' : '' }} required>
                @error('department')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="photo" class="form-label">Profile Photo</label>
                @if(auth()->user()->profile_photo_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Current Profile Photo" class="w-20 h-20 rounded-full object-cover">
                        <p class="text-sm text-gray-500 mt-1">Current photo will be used.</p>
                    </div>
                @else
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
                    @error('photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                @endif
            </div>

            <button type="submit" class="btn-submit">Submit Application</button>
        </form>
    </div>
@endsection