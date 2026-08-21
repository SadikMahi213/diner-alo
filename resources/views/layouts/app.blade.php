<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="দিনের আলো - মানব পরিবার পরিচালিত গাণসিয়কারিত্বিক সংস্থা">
    <meta name="keywords" content="দিনের আলো, বাঙালি, মানবিক, চ্যারিটি, দান, Zakat">
    <meta name="author" content="দিনের আলো">
    <meta property="og:title" content="দিনের আলো">
    <meta property="og:description" content="মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করি।">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    
    <title>@yield('title') - দিনের আলো</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-[#f8f9fa] font-bangla">
    <header class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-emerald-600">দিনের আলো</a>
            <nav class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">হোম</a>
                <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-emerald-600">ড্যাশবোর্ড</a>
                @auth
                    <span class="text-gray-600">হ্যালো, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">লগআউট</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; 2026 দিনের আলো. All rights reserved.
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
