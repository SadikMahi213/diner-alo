<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দ্বীনের আলো - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
    </style>
</head>
<body class="bg-[#f8f9fa]">
    <header class="bg-gray-900 text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-emerald-400">দ্বীনের আলো</h1>
                <span class="text-gray-300 hidden md:inline">হ্যালো, {{ Auth::user()->name }}</span>
            </div>
            <nav class="hidden md:flex items-center space-x-5 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-white font-medium">ড্যাশবোর্ড</a>
                <a href="{{ route('admin.donation-funds.index') }}" class="hover:text-emerald-300">ফান্ড</a>
                <a href="{{ route('admin.donations') }}" class="hover:text-emerald-300">দান</a>
                <a href="{{ route('admin.transactions.index') }}" class="hover:text-emerald-300">লেনদেন</a>
                <a href="{{ route('admin.donors') }}" class="hover:text-emerald-300">দাতা</a>
                <a href="{{ route('admin.volunteers') }}" class="hover:text-emerald-300">স্বেচ্ছাসেবক</a>
                <a href="{{ route('admin.members') }}" class="hover:text-emerald-300">সদস্য</a>
                <a href="{{ route('home') }}" class="hover:text-emerald-300">ফ্রন্ট</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">লগআউট</button>
            </form>
        </div>
    </header>

    <main class="py-8">
        <div class="container mx-auto px-4">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-gray-500 text-sm">মোট দান</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ number_format($totalDonations) }}</p>
                    <p class="text-xs text-gray-400 mt-1">আজ {{ $todayDonations }} • এই মাসে {{ $monthlyDonations }}</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-gray-500 text-sm">সফল লেনদেন</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ number_format($successfulTransactions) }}</p>
                    <p class="text-xs text-gray-400 mt-1">পেন্ডিং {{ $pendingTransactions }} • ব্যর্থ {{ $failedTransactions }}</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-gray-500 text-sm">মোট অর্থ (সফল)</p>
                    <p class="text-2xl font-bold text-emerald-600">৳{{ number_format($totalDonationAmount, 0) }}</p>
                    <p class="text-xs text-gray-400 mt-1">আজ ৳{{ number_format($todayDonationAmount, 0) }} • মাসে ৳{{ number_format($monthlyDonationAmount, 0) }}</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-gray-500 text-sm">সক্রিয় প্রজেক্ট</p>
                    <p class="text-3xl font-bold text-gold-600">{{ $activeProjects }}</p>
                    <p class="text-xs text-gray-400 mt-1">সম্পন্ন {{ $completedProjects }} • স্বেচ্ছাসেবক {{ $totalVolunteers }} (অনুমোদিত {{ $approvedVolunteers }})</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 border">
                    <p class="text-gray-500 text-sm">সদস্য</p>
                    <p class="text-2xl font-bold">{{ $totalMembers }}</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border">
                    <p class="text-gray-500 text-sm">ব্লগ</p>
                    <p class="text-2xl font-bold">{{ $totalBlogPosts }} <span class="text-sm font-normal text-gray-500">({{ $publishedBlogPosts }} প্রকাশিত)</span></p>
                </div>
                <div class="bg-white rounded-2xl p-6 border">
                    <p class="text-gray-500 text-sm">যোগাযোগ</p>
                    <p class="text-2xl font-bold">{{ $totalContactMessages }} <span class="text-sm font-normal text-emerald-600">({{ $newContactMessages }} নতুন)</span></p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('admin.donation-funds.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white p-4 rounded-xl text-center font-medium">ফান্ড ব্যবস্থাপনা</a>
                <a href="{{ route('admin.donations') }}" class="bg-white border hover:bg-gray-50 p-4 rounded-xl text-center font-medium">দান তালিকা</a>
                <a href="{{ route('admin.transactions.index') }}" class="bg-white border hover:bg-gray-50 p-4 rounded-xl text-center font-medium">লেনদেন</a>
                <a href="{{ route('admin.donors') }}" class="bg-white border hover:bg-gray-50 p-4 rounded-xl text-center font-medium">দাতা তালিকা</a>
            </div>

            <!-- Recent Donations (server-rendered) -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">সাম্প্রতিক দান</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">লেনদেন আইডি</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">দাতা</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">পরিমাণ</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">স্ট্যাটাস</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">তারিখ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $recent = \App\Models\Donation::with('donor')->latest()->take(5)->get(); @endphp
                            @forelse($recent as $d)
                                <tr>
                                    <td class="px-4 py-2 font-mono text-xs">{{ $d->transaction_id }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $d->donor?->name ?? 'অতিথি' }}</td>
                                    <td class="px-4 py-2 text-sm">৳{{ number_format($d->amount, 0) }}</td>
                                    <td class="px-4 py-2"><span class="px-2 py-1 text-xs rounded-full {{ $d->status=='successful' ? 'bg-green-100 text-green-800' : ($d->status=='pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">{{ $d->status }}</span></td>
                                    <td class="px-4 py-2 text-sm">{{ $d->created_at->format('d M, H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">এখনো কোনো দান নেই</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.export.donations') }}" class="text-sm text-emerald-600 hover:underline">CSV এক্সপোর্ট</a>
                    <a href="{{ route('admin.statistics') }}" class="text-sm text-gray-500">পরিসংখ্যান JSON</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-gray-400">
        &copy; 2026 দ্বীনের আলো - Diner Alo Foundation • <a href="{{ route('home') }}" class="hover:text-emerald-600">ফ্রন্ট দেখুন</a>
    </footer>
</body>
</html>
