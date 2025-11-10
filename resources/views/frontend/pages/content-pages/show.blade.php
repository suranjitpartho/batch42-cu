@extends('layouts.storefront')

@push('styles')
    @vite('resources/css/frontend/content-page.css')
@endpush

@section('content')
    <div x-data="{ activeTab: 'en' }">
        <div class="content-page-tabs-wrapper">
            <div class="content-page-tabs">
                <button @click="activeTab = 'en'" :class="{'active': activeTab === 'en'}" class="content-page-tab-button">English</button>
                <button @click="activeTab = 'bn'" :class="{'active': activeTab === 'bn'}" class="content-page-tab-button">বাংলা</button>
            </div>
        </div>
        <div class="content-page-container">
            <div class="content-page-card">
                <div class="content-page-header">
                    <div x-show="activeTab === 'en'">
                        <h1 class="content-page-title">{{ $contentPage->getTranslation('title', 'en') }}</h1>
                    </div>
                    <div x-show="activeTab === 'bn'" style="display: none;">
                        <h1 class="content-page-title">{{ $contentPage->getTranslation('title', 'bn') }}</h1>
                    </div>
                </div>
                <div x-show="activeTab === 'en'" class="content-page-content">
                    {!! nl2br(e($contentPage->getTranslation('content', 'en'))) !!}
                </div>
                <div x-show="activeTab === 'bn'" class="content-page-content" style="display: none;">
                    {!! nl2br(e($contentPage->getTranslation('content', 'bn'))) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
