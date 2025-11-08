<section class="university-section">
    <div class="info-section-container">
        <div class="info-column">
            <img src="{{ asset('images/logo-uni.png') }}" alt="University Logo" class="info-logo">
            <h2>University of Chittagong</h2>
            <p>{{ $info->university_history ?? '' }}</p>
            <a href="{{ route('university.show') }}" class="read-more-button">See More</a>
        </div>
        <div class="info-column">
            <img src="{{ asset('images/logo.png') }}" alt="Batch Logo" class="info-logo">
            <h2>Batch 42 (2006-2007)</h2>
            <p>{{ $info->batch_info ?? '' }}</p>
            <a href="{{ route('batch.show') }}" class="read-more-button">See More</a>
        </div>
    </div>
</section>
