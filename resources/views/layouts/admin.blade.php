<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - দিনের আলো</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="bg-gray-900 text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-emerald-400">দিনের আলো</h1>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-300">হোম</a></li>
                    <li><a href="{{ route('admin.packages.index') }}" class="hover:text-emerald-300">কার্যক্রম</a></li>
                    <li><a href="{{ route('home') }}" class="hover:text-emerald-300">ফ্রন্ট</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-4">
                <span style="font-size:0.875em;">{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    লগআউ�
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
</body>
</html>