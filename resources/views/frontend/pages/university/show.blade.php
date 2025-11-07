@extends('layouts.storefront')

@section('content')
    <div class="university-info-container">
        <div class="university-info-header">
            <h1>University of Chittagong</h1>
        </div>

        @if($info->university_main_photo_path)
            <div class="university-main-image-container">
                <img src="{{ asset('storage/' . $info->university_main_photo_path) }}" alt="University Main View" class="university-main-image">
            </div>
        @endif

        <div class="university-content-section">
            <h2>Our History</h2>
            <p>{!! nl2br(e($info->university_history)) !!}</p>
        </div>

        <div class="university-content-section">
            <h2>Mission</h2>
            <p>{!! nl2br(e($info->university_mission)) !!}</p>
        </div>

        <div class="university-content-section">
            <h2>Vision</h2>
            <p>{!! nl2br(e($info->university_vision)) !!}</p>
        </div>

        @php
            $galleryImages = array_filter([
                $info->university_detail_photo_1_path,
                $info->university_detail_photo_2_path,
                $info->university_detail_photo_3_path,
                $info->university_detail_photo_4_path,
                $info->university_detail_photo_5_path,
            ]);
        @endphp

        @if(!empty($galleryImages))
            <div class="university-gallery">
                <h2>Gallery</h2>
                <div class="scattered-gallery">
                    @foreach($galleryImages as $imagePath)
                        <div class="gallery-image-wrapper">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="University Gallery Image" class="gallery-image">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
