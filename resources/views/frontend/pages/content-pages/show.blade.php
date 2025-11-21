@extends('layouts.storefront')

@section('content')
    @php
        // Get translations without fallback to check for their actual presence.
        $englishContent = $contentPage->getTranslation('content', 'en', false);
        $bengaliContent = $contentPage->getTranslation('content', 'bn', false);

        $hasEnglish = !empty($englishContent);
        $hasBengali = !empty($bengaliContent);
    @endphp

    @if (in_array($contentPage->slug, ['president-message', 'secretary-message']))
        @php
            $enData = json_decode($contentPage->getTranslation('content', 'en'), true);
            // For these pages, we might only have English JSON structure but with BN content inside it if the seeder/controller structure is followed strictly.
            // However, let's check both.
            // Based on seeder: 'content' => ['en' => json_encode(...), 'bn' => null]
            // So we only need to parse the 'en' translation which contains the JSON with both en and bn fields.
            
            $messageData = json_decode($contentPage->getTranslation('content', 'en'), true);
        @endphp

        <div x-data="{ activeTab: 'bn' }">
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
                            <p class="text-xl text-fe-secondary mt-2 font-medium">{{ $messageData['name_en'] ?? '' }}</p>
                        </div>
                        <div x-show="activeTab === 'bn'" style="display: none;">
                            <h1 class="content-page-title">{{ $contentPage->getTranslation('title', 'bn') }}</h1>
                            <p class="text-xl text-fe-secondary mt-2 font-medium font-bengali">{{ $messageData['name_bn'] ?? '' }}</p>
                        </div>
                    </div>
                    
                    <div x-show="activeTab === 'en'" class="content-page-content">
                        <div class="prose max-w-none text-justify">
                            {!! nl2br(e($messageData['message_en'] ?? '')) !!}
                        </div>
                    </div>
                    <div x-show="activeTab === 'bn'" class="content-page-content" style="display: none;">
                        <div class="prose max-w-none text-justify font-bengali">
                            {!! nl2br(e($messageData['message_bn'] ?? '')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif ($hasEnglish && $hasBengali)
        {{-- Show tabbed interface if both languages are present --}}
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
                        {!! nl2br(e($englishContent)) !!}
                    </div>
                    <div x-show="activeTab === 'bn'" class="content-page-content" style="display: none;">
                        {!! nl2br(e($bengaliContent)) !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Show single language view if only one is present --}}
        <div class="content-page-container">
            <div class="content-page-card">
                <div class="content-page-header">
                    @if ($hasEnglish)
                        <h1 class="content-page-title">{{ $contentPage->getTranslation('title', 'en') }}</h1>
                    @elseif ($hasBengali)
                        <h1 class="content-page-title">{{ $contentPage->getTranslation('title', 'bn') }}</h1>
                    @else
                        {{-- Fallback for a page with no content in either language --}}
                        <h1 class="content-page-title">{{ $contentPage->title }}</h1>
                    @endif
                </div>
                <div class="content-page-content">
                    @if ($hasEnglish)
                        {!! nl2br(e($englishContent)) !!}
                    @elseif ($hasBengali)
                        {!! nl2br(e($bengaliContent)) !!}
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection
