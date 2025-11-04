@extends('layouts.storefront')

@section('content')
    <div class="event-detail-section">
        <div class="event-detail-container">
            <div class="event-detail-header">
                <h1 class="event-detail-title">{{ $event->title }}</h1>
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

            <div class="event-detail-gallery">
                <div class="main-image">
                    <img src="{{ Storage::url($event->images->first()->image_path) }}" alt="{{ $event->title }}" id="main-event-image">
                </div>
                @if ($event->images->count() > 1)
                    <div class="thumbnail-images">
                        @foreach ($event->images as $image)
                            <img src="{{ Storage::url($image->image_path) }}" alt="{{ $event->title }}" class="thumbnail" onclick="document.getElementById('main-event-image').src = this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="event-detail-description">
                <h2 class="section-title">About the Event</h2>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>
@endsection
