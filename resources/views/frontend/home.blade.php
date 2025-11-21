@extends('layouts.storefront')

@section('content')
    <div class="hero-section">
        @if($heroBanners->isNotEmpty())
        <div class="hero-cover-photo"
             x-data="{
                activeSlide: 1,
                lastSlide: {{ $heroBanners->count() }},
                autoplay: null,
                startAutoplay() {
                    this.autoplay = setInterval(() => {
                        this.activeSlide = this.activeSlide === this.lastSlide ? 1 : this.activeSlide + 1;
                    }, 5000);
                },
                stopAutoplay() {
                    clearInterval(this.autoplay);
                }
             }"
             x-init="startAutoplay()">

            <div class="slider-wrapper">
                @foreach ($heroBanners as $index => $banner)
                    <div class="slide"
                         x-show="activeSlide === {{ $index + 1 }}"
                         x-transition:enter="transition ease-out duration-1000"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-1000"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="slide-image">
                        <div class="slide-text-content">
                            <h2>{{ $banner->title }}</h2>
                            <p>{{ $banner->subtitle }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="slider-dots">
                @foreach ($heroBanners as $index => $banner)
                    <span class="dot" 
                          :class="{ 'active': activeSlide === {{ $index + 1 }} }" 
                          @click="activeSlide = {{ $index + 1 }}; stopAutoplay(); startAutoplay();"></span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    @include('frontend.partials._university-section', ['info' => $info])
    @include('frontend.partials._membership-promo')
    @include('frontend.partials._events')
    @include('frontend.partials._notices')
    @include('frontend.partials._messages')

@endsection
