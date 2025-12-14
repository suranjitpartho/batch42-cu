@extends('layouts.storefront')

@section('content')
<div class="bg-fe-background min-h-screen py-16 relative overflow-hidden">
    {{-- Decorative BGs --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
         <div class="absolute top-[-10%] left-[-5%] w-[50rem] h-[50rem] bg-fe-primary/5 rounded-full blur-3xl mix-blend-multiply"></div>
         <div class="absolute bottom-[-10%] right-[-5%] w-[50rem] h-[50rem] bg-fe-secondary/5 rounded-full blur-3xl mix-blend-multiply"></div>
         <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-fe-spaceblack mb-4">Committee Archives</h1>
            <div class="h-1 w-24 bg-gradient-to-r from-fe-primary to-fe-secondary mx-auto rounded-full"></div>
            <p class="mt-4 text-fe-spacegrey text-lg max-w-2xl mx-auto">
                Explore the history of our leadership. Access documents and records of past executive committees and advisory panels.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($committees as $committee)
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-fe-light-border hover:-translate-y-1 overflow-hidden" x-data="{ showPdfModal: false }">
                    
                    {{-- Card Decoration --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-fe-accent rounded-full blur-2xl -mr-10 -mt-10 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-fe-background text-fe-primary group-hover:bg-fe-primary group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-users text-xl"></i>
                            </span>
                            @if(isset($latestCommitteeId) && $committee->id === $latestCommitteeId)
                                <span class="bg-fe-success/10 text-fe-success text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    Current
                                </span>
                            @endif
                        </div>

                        <h3 class="text-2xl font-bold text-fe-spaceblack mb-2">{{ $committee->year }}</h3>
                        <p class="text-sm text-fe-spacegrey font-medium mb-6 uppercase tracking-wider">Executive Committee</p>

                        <button @click="showPdfModal = true" class="w-full py-3 rounded-xl border-2 border-fe-primary/10 text-fe-primary font-semibold hover:bg-fe-primary hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <span>View Document</span>
                            <i class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                        </button>
                    </div>

                    {{-- Individual Modal per item (Basic Implementation) --}}
                     <div x-show="showPdfModal" 
                        style="display: none;"
                        class="fixed inset-0 z-[100] overflow-y-auto" 
                        role="dialog" 
                        aria-modal="true">
                        
                        <div x-show="showPdfModal"
                            x-transition:enter="ease-out duration-300"
                            class="fixed inset-0 bg-fe-spaceblack/80 backdrop-blur-sm transition-opacity" 
                            @click="showPdfModal = false"></div>

                        <div class="flex min-h-screen items-center justify-center p-4">
                            <div x-show="showPdfModal"
                                @click.away="showPdfModal = false"
                                class="relative w-full max-w-5xl h-[80vh] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden">
                                
                                <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                                    <h3 class="font-bold text-lg">Executive Committee {{ $committee->year }}</h3>
                                    <button @click="showPdfModal = false" class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                <div class="flex-1 bg-gray-200 relative">
                                     <iframe src="{{ asset('storage/' . $committee->document_path) }}" class="w-full h-full absolute inset-0" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-fe-background rounded-full flex items-center justify-center mx-auto mb-6 text-fe-spacegrey/30">
                        <i class="fas fa-folder-open text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-fe-spacegrey">No archives found</h3>
                    <p class="text-fe-spacegrey/60">Archives will appear here once uploaded.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $committees->links() }}
        </div>
    </div>
</div>
@endsection
