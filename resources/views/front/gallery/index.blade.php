@extends('layouts.front')
@section('title', 'গ্যালারি')
@section('content')

    <!-- Gallery Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    গ্যালারি
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    আমাদের ঘটনাগুলো এবং কার্যক্রমের ছবি।
                </p>
            </div>
        </div>
    </section>

    <!-- Gallery Filter -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 mb-6">
                    <button class="px-4 py-2 border border-emerald-200 rounded-lg bg-emerald-50 text-emerald-600 text-sm font-medium hover:bg-emerald-100 transition-colors">
                        All
                    </button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        Education
                    </button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        Medical
                    </button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        Food
                    </button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        Events
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Albums -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($albums as $album)
                    <div class="bg-white rounded-2xl overflow-hidden hover-transition transform hover:shadow-lg">
                        <!-- Album Cover -->
                        <div class="relative">
                            <img src="https://via.placeholder.com/400x300/e5e7eb/6b7280?text={{ $album->title }}"
                                alt="{{ $album->title }}"
                                class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="text-xs text-emerald-400 bg-emerald-50 rounded px-2 py-1 bengali">{{ $album->category }}</span>
                            </div>
                            
                            <!-- Title -->
                            <div class="absolute bottom-3 left-3 right-3 bg-white p-3 rounded text-center">
                                <h3 class="text-emerald-600 font-medium bengali">{{ $album->title }}</h3>
                                <p class="text-gray-500 text-xs">{{ $album->event_year ?? '2024' }}</p>
                            </div>
                        </div>
                        
                        <!-- Item Count -->
                        <div class="p-3 border-t border-gray-100">
                            <p class="text-gray-500 text-sm bengali">{{ $album->items->count() }} images</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal (placeholder) -->
    <div id="lightbox" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-full object-contain">
        <button id="lightbox-close" class="absolute top-4 right-4 text-white text-2xl hover-opacity-80 transition-opacity">
            &times;
        </button>
    </div>

@endsection

@section('scripts')
    <script>
        // Lightbox functionality
        document.addEventListener('DOMContentLoaded', function() {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxClose = document.getElementById('lightbox-close');
            
            // Open lightbox on image click
            document.querySelectorAll('.gallery-item-img').forEach(img => {
                img.addEventListener('click', function() {
                    lightboxImg.src = this.src;
                    lightbox.classList.remove('hidden');
                    lightbox.classList.add('block');
                });
            });
            
            // Close lightbox
            lightboxClose.addEventListener('click', function() {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('block');
            });
            
            // Close on outside click
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('block');
                }
            });
        });
    </script>
@endsection
