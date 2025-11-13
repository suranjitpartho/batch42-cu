<section class="events-section">
    <div class="events-section-header">
        <h2 class="events-section-title">Recent Events</h2>
        <p class="events-section-subtitle">Stay updated with our latest events and gatherings.</p>
    </div>

    <div class="events-grid">
        @foreach ($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="event-card">
                <div class="event-card-photo-frame">
                    @foreach ($event->images->take(3) as $index => $image)
                        <img src="{{ Storage::url($image->image_path) }}" alt="{{ $event->title }}" class="event-card-image event-card-image-{{ $index + 1 }}">
                    @endforeach
                </div>
                <div class="event-card-info">
                    <h3 class="event-card-title">{{ $event->title }}</h3>
                    <p class="event-card-date">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>{{ $event->date->format('d M Y') }}</span>
                    </p>
                    <p class="event-card-location">
                        <i class="fa-solid fa-map-marker-alt"></i>
                        <span>{{ $event->location }}</span>
                    </p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="events-section-footer">
        @if($showAllEventsButton)
            <a href="{{ route('events.index') }}" class="btn-show-all-events">Show All Events</a>
        @endif
    </div>
</section>
