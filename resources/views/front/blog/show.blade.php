<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
        .prose bengali { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif; }
    </style>
</head>
<body class="bg-bg font-bg">

    <!-- Blog Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    {{ $post->title }}
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    Published on {{ $post->created_at->format('F j, Y') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto prose">
                {!! $post->content !!}
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-emerald-600 mb-6 bengoli>Related Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($relatedPosts as $related)
                    <article class="bg-white rounded-xl p-5 border border-gray-100 hover-transition">
                        <div class="h-40 w-full overflow-hidden rounded-md mb-4">
                            <img src="https://via.placeholder.com/400x250/e5e7eb/6b7280?text=Related"
                                alt="{{ $related->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <h3 class="text-emerald-600 font-medium line-clamp-2 bengali hover:text-emerald-500 transition-colors">{{ $related->title }}</h3>
                        <p class="text-gray-500 text-xs line-clamp-1 mt-2 bengali">{{ substr($related->excerpt ?? '', 0, 80) }}...</p>
                        <a href="{{ route('blog.show', $related->slug) }}"
                            class="text-emerald-500 text-sm font-medium mt-3 block hover-underline-opacity-50">
                            Read more
                        </a>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <p class="text-gray-400 text-lg mb-6 bengoli>
                    নতুন আপডেট পেতে নিউজলেটার subscrition করুন।
                </p>
                <form class="bg-white rounded-2xl p-8 max-w-md mx-auto border border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="email"
                            placeholder="your email@address.com"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                            required>
                        <button type="submit"
                            class="bg-emerald text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-dark transition-colors w-full">
                            subscrition
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>