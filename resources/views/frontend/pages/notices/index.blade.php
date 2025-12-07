@extends('layouts.storefront')

@section('content')
    <div class="all-notices-section">
        <div class="all-notices-header">
            <h1>All Notices</h1>
            <p>Stay updated with our latest announcements.</p>
        </div>

        <div class="notice-grid-container">
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

            <div class="frontend-pagination-container">
                {{ $notices->links() }}
            </div>
        </div>
    </div>
@endsection
