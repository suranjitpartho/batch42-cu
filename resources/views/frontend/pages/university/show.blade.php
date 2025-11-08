@extends('layouts.storefront')

@section('content')
    <div class="info-page-container">
        <div class="info-page-header">
            <h1>University of Chittagong</h1>
        </div>

        @if($info->university_main_photo_path)
            <div class="info-main-image-container">
                <img src="{{ asset('storage/' . $info->university_main_photo_path) }}" alt="University Main View" class="info-main-image">
            </div>
        @endif

        <div class="info-content-section">
            <h2>Our History</h2>
            <p>{!! nl2br(e($info->university_history)) !!}</p>
        </div>

        <div class="info-content-section">
            <h2>Mission</h2>
            <p>{!! nl2br(e($info->university_mission)) !!}</p>
        </div>

        <div class="info-content-section">
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
            <div class="info-gallery">
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
