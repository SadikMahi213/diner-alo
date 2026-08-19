<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name_bn }} - দিনের আলো</title>
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
                    {{ $category->name_bn }}
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    {{ $category->description || 'Related blog posts' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Posts -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                
                <!-- Back Link -->
                <div class="mb-8">
                    <a href="{{ route('blog.index') }}"
                        class="bg-gray-800 text-white px-6 py-3 rounded-full font-medium hover:bg-gray-700 transition-colors text-lg">
                        <- সকল ব্লগ পোস্ট
                    </a>
                </div>
                
                <!-- Blog Posts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @if(empty($posts))
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No posts found in this category.</p>
                    </div>
                    @endif
                    
                    @foreach($posts as $post)
                    <article class="bg-white rounded-2xl border border-gray-100 hover-transition overflow-hidden">
                        <div class="relative">
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
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 bengali">{{ substr($post->excerpt ?? '', 0, 120) }}...</p>
                            
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

</body>
</html>