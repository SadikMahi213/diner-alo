<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ব্লগ - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-bg font-bg">

    <!-- Blog Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    ব্লগ
                </h2>
                <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto bengali">
                    মানবিক গল্প, কার্যকromycin খবর এবং সচেতনতাcontains।
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Categories -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <?php
                $categories = [
                    ['name_bn' => 'মানবিক গল্প', 'name_en' => 'Human Stories', 'slug' => 'human-stories'],
                    ['name_bn' => 'কার্যক্রমের খবর', 'name_en' => 'Program News', 'slug' => 'program-news'],
                    ['name_bn' => 'শিক্ষা', 'name_en' => 'Education', 'slug' => 'education'],
                    ['name_bn' => 'সচেতনতা', 'name_en' => 'Awareness', 'slug' => 'awareness'],
                    ['name_bn' => 'ইসলামিক জীবন', 'name_en' => 'Islamic Life', 'slug' => 'islamic-life'],
                    ['name_bn' => 'সংগঠনের আপডেট', 'name_en' => 'Organization Update', 'slug' => 'organization-update'],
                ];
                foreach ($categories as $cat):
                ?>
                <div>
                    <a href="{{ route('blog.category', $cat['slug']) }}"
                        class="bg-gray-50 hover:bg-emerald-50 border border-emerald-200 rounded-lg p-4 text-left transition-colors group">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3"/></svg>
                        </div>
                        <div>
                            <h3 class="text-emerald-600 font-medium hover:text-emerald-500 transition-colors text-sm bengali">{{ $cat['name_bn'] }}</h3>
                            <p class="text-gray-500 text-xs mt-1 bengali">{{ $cat['name_en'] }}</p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Blog Posts -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                
                <!-- Blog Search and Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 mb-8 hover-transition">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <h3 class="text-emerald-600 font-medium mb-3 bengoli>Category</h3>
                            <ul class="space-y-2 text-sm text-gray-600 bengali">
                                <li><a href="#!" class="hover:text-emerald-400 transition-colors">সবার Baxter</a></li>
                                <li><a href="#!" class="hover:text-emerald-400 transition-colors">মানবিক গল্প Baxter</a></li>
                                <li><a href="#!" class="hover:text-emerald-400 transition-colors">শিক্ষ Baxter</a></li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-emerald-600 font-medium mb-3 bengoli>Archives</h3>
                            <ul class="space-y-2 text-sm text-gray-600 bengali">
                                <li><a href="#!" class="hover:text-emerald-400 transition-colors">December 2024 Baxter</a></li>
                                <li><a href="#!" class="hover:text-emerald-400 transition-colors">November 2024 Baxter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Blog Posts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                    <article class="bg-white rounded-2xl border border-gray-100 hover-transition overflow-hidden">
                        <div class="relative">
                            <!-- Thumbnail -->
                            <div class="h-48 w-full overflow-hidden">
                                <img src="https://via.placeholder.com/600x400/e5e7eb/6b7280?text=Blog+Thumbnail"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            
                            <div class="absolute top-3 left-3 flex flex-col">
                                <span class="text-xs text-emerald-400 bg-emerald-50 rounded px-2 py-1 bengali">{{ $post->category->name_en }}</span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-emerald-600 mb-3 line-clamp-2 bengali">{{ $post->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 bengali">{{ substr($post->excerpt ?? '', 0, 150) }}...</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium">
                                        {{ Str::upper(substr($post->author ?? 'Admin', 0, 1)) }}
                                    </div>
                                    <span class="text-gray-500 text-sm">{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="text-emerald-600 font-medium hover:text-emerald-500 transition-colors text-sm">
                                    Read more
                                    <svg class="w-3 h-3 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.7 10l4.1-2.3L22 4M1 8l4 6 14 2l1.4-1.3m-4.1 2.3L3.9 8l4 6L1 8"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    
                    <!-- Pagination -->
                    @if($posts->hasMorePages())
                    <div class="mt-8 flex justify-center">
                        <nav aria-label="Blog pagination">
                            <ul class="flex space-x-2">
                                @if($posts->onFirstPage())
                                <li class="disabled text-gray-400">
                                    <a href="#" class="px-4 py-2 border rounded hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50">
                                        Previous
                                    </a>
                                @else
                                <li>
                                    <a href="{{ $posts->previousPageUrl() }}"
                                        class="px-4 py-2 border rounded bg-emerald text-white hover:bg-emerald-dark transition-colors">
                                        Previous
                                    </a>
                                @endif
                                @if($posts->hasMorePages())
                                <li>
                                    <a href="{{ $posts->nextPageUrl() }}"
                                        class="px-4 py-2 border rounded bg-emerald text-white hover:bg-emerald-dark transition-colors">
                                        Next
                                    </a>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-600 mb-4 bengali>
                    নিউজলেটার subscrition
                </h2>
                <p class="text-gray-400 text-lg mb-6 bengali>
                    নতুন আপডেট এবং খবর পেতে আমারে নিউজলেটার subscrition করুন।
                </p>
                <form class="bg-white rounded-2xl p-8 max-w-md mx-auto border border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="email"
                            placeholder="your email@address.com"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                            required>
                        <button type="submit"
                            class="bg-emerald text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-dark transition-colors">
                            subscrition
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>