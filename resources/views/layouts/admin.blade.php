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
                <ul class="flex space-x-4 text-sm">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-300">ড্যাশবোর্ড</a></li>
                    <li><a href="{{ route('admin.donation-funds.index') }}" class="hover:text-emerald-300">ফান্ড</a></li>
                    <li><a href="{{ route('admin.donations') }}" class="hover:text-emerald-300">দান</a></li>
                    <li><a href="{{ route('admin.transactions.index') }}" class="hover:text-emerald-300">লেনদেন</a></li>
                    <li><a href="{{ route('admin.donors') }}" class="hover:text-emerald-300">দাতা</a></li>
                    <li><a href="{{ route('admin.volunteers') }}" class="hover:text-emerald-300">স্বেচ্ছাসেবক</a></li>
                    <li><a href="{{ route('admin.members') }}" class="hover:text-emerald-300">সদস্য</a></li>
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