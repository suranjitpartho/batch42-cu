@extends('layouts.storefront')

@push('styles')
    @vite('resources/css/frontend/content-page.css')
@endpush

@section('content')
    <div class="content-page-container">
        <div class="content-page-card">
            <div class="content-page-header">
                <h1 class="content-page-title">{{ $contentPage->title }}</h1>
            </div>
            <div class="content-page-content">
                {!! nl2br(e($contentPage->content)) !!}
            </div>
        </div>
    </div>
@endsection
