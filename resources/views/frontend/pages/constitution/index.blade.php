@extends('layouts.storefront')

@section('content')
    <div class="min-h-screen bg-fe-background py-12 px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'bn', mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto">
            
            {{-- Header Section --}}
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-light tracking-wide text-fe-primary-dark mb-4 uppercase">
                    <span x-show="activeTab === 'en'" style="display: none;">Alumni Constitution</span>
                    <span x-show="activeTab === 'bn'">অ্যালামনাই সংবিধান</span>
                </h1>
                <div class="w-24 h-1 bg-fe-primary mx-auto rounded-full"></div>
                
                {{-- Language Toggle --}}
                <div class="mt-6 flex justify-center gap-4">
                    <button 
                        @click="activeTab = 'en'" 
                        :class="{'text-fe-primary border-b-2 border-fe-primary': activeTab === 'en', 'text-fe-spacegrey hover:text-fe-primary-dark': activeTab !== 'en'}"
                        class="pb-1 font-medium transition-colors duration-200 text-lg focus:outline-none"
                    >
                        English
                    </button>
                    <button 
                        @click="activeTab = 'bn'" 
                        :class="{'text-fe-primary border-b-2 border-fe-primary': activeTab === 'bn', 'text-fe-spacegrey hover:text-fe-primary-dark': activeTab !== 'bn'}"
                        class="pb-1 font-medium transition-colors duration-200 text-lg focus:outline-none"
                    >
                        বাংলা
                    </button>
                </div>
            </div>

            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-start relative">
                
                {{-- Sidebar Navigation (Desktop) --}}
                <div class="hidden lg:block lg:col-span-3 sticky top-28">
                    <nav class="space-y-1" aria-label="Sidebar">
                        @foreach ($chapters as $chapter)
                            <a href="#chapter-{{ $chapter->id }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 hover:bg-fe-primary/5 text-fe-spacegrey hover:text-fe-primary-dark"
                            >
                                <span class="truncate">
                                    <span class="font-bold mr-1">{{ $chapter->chapter_number }}:</span>
                                    <span x-show="activeTab === 'en'" style="display: none;">{{ $chapter->getTranslation('chapter_name', 'en') }}</span>
                                    <span x-show="activeTab === 'bn'">{{ $chapter->getTranslation('chapter_name', 'bn') }}</span>
                                </span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Mobile Navigation (Sticky & Floating) --}}
                <div class="lg:hidden sticky top-24 z-40 mb-6 -mx-4 px-4 py-2 bg-fe-background/95 backdrop-blur-sm border-b border-fe-light-border/50 shadow-sm">
                    <div class="relative">
                        <button 
                            @click="mobileMenuOpen = !mobileMenuOpen" 
                            type="button" 
                            class="w-full flex items-center justify-between px-4 py-3 border border-fe-light-border/50 rounded-lg shadow-sm text-sm font-medium text-fe-primary-dark bg-white hover:bg-gray-50 focus:outline-none transition-all duration-200"
                        >
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-fe-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                <span>
                                    <span x-show="activeTab === 'en'" style="display: none;">Table of Contents</span>
                                    <span x-show="activeTab === 'bn'">সূচিপত্র</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-fe-spacegrey transform transition-transform duration-200" :class="{'rotate-180': mobileMenuOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div 
                            x-show="mobileMenuOpen" 
                            style="display: none;" 
                            @click.away="mobileMenuOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 left-0 mt-2 origin-top bg-white border border-fe-light-border rounded-md shadow-xl max-h-[60vh] overflow-y-auto z-50"
                        >
                            <div class="py-1">
                                @foreach ($chapters as $chapter)
                                    <a href="#chapter-{{ $chapter->id }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-sm text-fe-spacegrey hover:bg-fe-primary/5 hover:text-fe-primary-dark border-b border-fe-light-border/30 last:border-0">
                                        <span class="font-bold mr-1 text-fe-primary">{{ $chapter->chapter_number }}:</span>
                                        <span x-show="activeTab === 'en'" style="display: none;">{{ $chapter->getTranslation('chapter_name', 'en') }}</span>
                                        <span x-show="activeTab === 'bn'">{{ $chapter->getTranslation('chapter_name', 'bn') }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-9 space-y-8">
                    @forelse ($chapters as $chapter)
                        <div id="chapter-{{ $chapter->id }}" class="bg-white rounded-lg shadow-sm border border-fe-light-border overflow-hidden transition-shadow hover:shadow-md scroll-mt-24">
                            {{-- Chapter Header --}}
                            <div class="bg-fe-primary/5 px-6 py-4 border-b border-fe-light-border flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-fe-primary-dark">
                                    <span class="text-fe-primary mr-2">
                                        {{ $chapter->chapter_number }}
                                    </span>
                                    <span x-show="activeTab === 'en'" style="display: none;">
                                        {{ $chapter->getTranslation('chapter_name', 'en') }}
                                    </span>
                                    <span x-show="activeTab === 'bn'">
                                        {{ $chapter->getTranslation('chapter_name', 'bn') }}
                                    </span>
                                </h2>
                            </div>

                            {{-- Chapter Content --}}
                            <div class="p-6 md:p-8">
                                <div x-show="activeTab === 'en'" style="display: none;" class="prose max-w-none text-fe-spaceblack leading-relaxed text-justify">
                                    {!! nl2br(e($chapter->getTranslation('content', 'en'))) !!}
                                </div>
                                <div x-show="activeTab === 'bn'" class="prose max-w-none text-fe-spaceblack leading-relaxed text-justify font-bengali">
                                    {!! nl2br(e($chapter->getTranslation('content', 'bn'))) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-fe-light-border">
                            <p class="text-fe-text-light text-lg">
                                <span x-show="activeTab === 'en'" style="display: none;">No constitution chapters found.</span>
                                <span x-show="activeTab === 'bn'">কোন সংবিধান অধ্যায় পাওয়া যায়নি।</span>
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection
