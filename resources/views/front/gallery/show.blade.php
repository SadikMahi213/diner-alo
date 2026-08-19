<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->title }} - দিনের আলো গ্যালারি</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-bg font-bg">

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
        <button id="lightbox-close" class="absolute top-4 right-4 text-white text-3xl hover-opacity-80 transition-opacity &times;">
        </button>
    </div>

    <script>
        // Gallery initialization
        document.addEventListener('DOMContentLoaded', function() {
            const galleryGrid = document.getElementById('gallery-grid');
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxClose = document.getElementById('lightbox-close');
            
            // Filter functionality
            const filterButtons = document.querySelectorAll('#gallery-grid .filter-btn');
            const galleryItems = document.querySelectorAll('#gallery-grid .gallery-item');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('bg-emerald-50', 'text-emerald-600'));
                    filterButtons.forEach(btn => btn.classList.add('text-gray-600', 'bg-white'));
                    
                    // Add active class to clicked button
                    this.classList.remove('text-gray-600', 'bg-white');
                    this.classList.add('bg-emerald-50', 'text-emerald-600');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    galleryItems.forEach(item => {
                        if (filter === 'all' || item.getAttribute('data-category') === filter) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                            }, 100);
                        } else {
                            item.style.opacity = '0';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
            
            // Lightbox functionality
            galleryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const lightboxImg = document.getElementById('lightbox-img');
                    lightboxImg.src = this.querySelector('img').src;
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

</body>
</html>