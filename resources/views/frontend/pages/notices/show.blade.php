@extends('layouts.storefront')

@section('content')
    <div class="notice-detail-container">
        <div class="notice-detail-card">
            <div class="notice-detail-header">
                <div class="header-main-content">
                    <h1 class="notice-detail-title">{{ $notice->title }}</h1>
                    <p class="notice-detail-date"><span class="notice-detail-date-tag">Published on {{ $notice->created_at->format('d M Y') }}</span></p>
                </div>
                <div class="header-divider"></div>
                <div class="header-icon-container">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
            </div>
            <div class="notice-detail-content">
                {!! nl2br(e($notice->content)) !!}
            </div>
        </div>
    </div>
@endsection
