
<section class="notice-section">
    <div class="notice-section-header">
        <h2 class="notice-section-title">Latest Notices</h2>
        <p class="notice-section-subtitle">Important announcements and updates.</p>
    </div>

    <div class="notice-grid">
        @foreach ($notices as $notice)
            <a href="{{ route('notices.show', $notice) }}" class="notice-card">
                <div class="notice-card-content">
                    <h3 class="notice-card-title"><i class="fa-solid fa-bullhorn"></i> {{ $notice->title }}</h3>
                    <p class="notice-card-excerpt">{{ strip_tags($notice->content) }}</p>
                    <div class="notice-card-tags">
                        <span class="notice-card-date-tag">{{ $notice->created_at->format('d M Y') }}</span>
                        @if($notice->members_only)
                            <span class="notice-card-member-tag">For Alumnis</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="notice-section-footer">
        @if($showAllNoticesButton)
            <a href="{{ route('notices.index') }}" class="btn-show-all-notices">Show All Notices</a>
        @endif
    </div>
</section>
