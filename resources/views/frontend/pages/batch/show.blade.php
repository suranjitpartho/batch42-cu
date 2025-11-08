@extends('layouts.storefront')

@section('content')
    <div class="info-page-container">
        <div class="info-page-header">
            <h1>Batch 42 (2006-07)</h1>
        </div>

        <div class="info-content-section">
            <h2>About Our Batch</h2>
            <p>{!! nl2br(e($info->batch_info)) !!}</p>
        </div>

        @php
            $galleryImages = array_filter([
                $info->batch_detail_photo_1_path,
                $info->batch_detail_photo_2_path,
                $info->batch_detail_photo_3_path,
                $info->batch_detail_photo_4_path,
                $info->batch_detail_photo_5_path,
            ]);
        @endphp

        @if(!empty($galleryImages))
            <div class="info-gallery">
                <h2>Gallery</h2>
                <div class="scattered-gallery">
                    @foreach($galleryImages as $imagePath)
                        <div class="gallery-image-wrapper">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Batch Gallery Image" class="gallery-image">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
