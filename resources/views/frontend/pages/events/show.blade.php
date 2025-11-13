@extends('layouts.storefront')

@section('content')
    <div class="info-page-container event-detail-page" x-data="{ showModal: false, modalImage: '' }">
        <div class="info-page-header">
            <h1>{{ $event->title }}</h1>
            <div class="event-detail-meta">
                <p class="event-detail-date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>{{ $event->date->format('d M Y, H:i A') }}</span>
                </p>
                <p class="event-detail-location">
                    <i class="fa-solid fa-map-marker-alt"></i>
                    <span>{{ $event->location }}</span>
                </p>
            </div>
        </div>

        @php
            $coverImage = $event->images->first();
            $galleryImages = $event->images->slice(1);
        @endphp

        @if($coverImage)
            <div class="info-main-image-container event-cover-image-container">
                <img src="{{ Storage::url($coverImage->image_path) }}" alt="{{ $event->title }} Cover Image" class="info-main-image">
            </div>
        @endif

        <div class="info-content-section">
            <h2>About this event</h2>
            <p>{!! nl2br(e($event->description)) !!}</p>
        </div>

        @if($galleryImages->isNotEmpty())
            <div class="info-gallery">
                <h2>Gallery</h2>
                <div class="scattered-gallery">
                    @foreach($galleryImages as $image)
                        <div class="gallery-image-wrapper" @click="showModal = true; modalImage = '{{ Storage::url($image->image_path) }}'">
                            <img src="{{ Storage::url($image->image_path) }}" alt="Event Gallery Image" class="gallery-image">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Modal HTML -->
        <div x-show="showModal" class="image-modal-container" @click.self="showModal = false" @keydown.escape.window="showModal = false" style="display: none;">
            <div class="image-modal-content">
                <button class="image-modal-close" @click="showModal = false">&times;</button>
                <img :src="modalImage" alt="Gallery Image Preview">
            </div>
        </div>
    </div>
@endsection
