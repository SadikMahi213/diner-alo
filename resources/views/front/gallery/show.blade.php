@extends('layouts.front')
@section('title', '{{ $album->title }}')
@section('content')

    <!-- Gallery Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    {{ $album->title }}
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    {{ $album->description || 'Event gallery' }}
                </p>
                <p class="text-gray-500 text-sm">{{ $album->event_year ?? date('Y') }} | {{ $album->items->count() }} images</p>
            </div>
        </div>
    </section>

    <!-- Gallery Images -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                <!-- Filter Buttons -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-6">
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors all">All</button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors education">Education</button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors medical">Medical</button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors food">Food</button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors events">Events</button>
                    <button class="px-4 py-2 border rounded-lg bg-white text-gray-600 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-600 transition-colors volunteer">Volunteer</button>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
                    @foreach($album->items as $item)
                    <div class="gallery-item cursor-pointer group">
                        <img src="{{ $item->url }}"
                            alt="{{ $item->caption }}"
                            class="w-full h-auto rounded-lg overflow-hidden transition-transform duration-300 group-hover:opacity-90"
                            data-category="{{ $album->category }}"
                            data-lightbox>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50">
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-full object-contain">
        <button id="lightbox-close" class="absolute top-4 right-4 text-white text-3xl hover-opacity-80 transition-opacity">
            &times;
        </button>
    </div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var galleryGrid = document.getElementById('gallery-grid');
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightbox-img');
    var lightboxClose = document.getElementById('lightbox-close');

    var filterButtons = document.querySelectorAll('#gallery-grid .filter-btn');
    var galleryItems = document.querySelectorAll('#gallery-grid .gallery-item');

    filterButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            filterButtons.forEach(function(btn) { btn.classList.remove('bg-emerald-50', 'text-emerald-600'); });
            filterButtons.forEach(function(btn) { btn.classList.add('text-gray-600', 'bg-white'); });
            this.classList.remove('text-gray-600', 'bg-white');
            this.classList.add('bg-emerald-50', 'text-emerald-600');
            var filter = this.getAttribute('data-filter');
            galleryItems.forEach(function(item) {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                    setTimeout(function() { item.style.opacity = '1'; }, 100);
                } else {
                    item.style.opacity = '0';
                    setTimeout(function() { item.style.display = 'none'; }, 300);
                }
            });
        });
    });

    galleryItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = this.querySelector('img').src;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('block');
        });
    });

    lightboxClose.addEventListener('click', function() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('block');
    });

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('block');
        }
    });
});
</script>
@endsection
