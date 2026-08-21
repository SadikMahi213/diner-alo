<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="দ্বীনের আলো - মানব পরিবার পরিচালিত ইসলামিক সমাজকল্যাণ সংস্থা। বাংলাদেশের দারিদ্র এবং সামাজিকভাবে পিছড়া communities সাহায্য করে।">
    <meta name="keywords" content="দ্বীনের আলো, Diner Alo, বাঙালি, মানবিক, চ্যারিটি, দান, Zakat, খাদ্য, শিক্ষা, চিকিৎসা, ভোলান্টিয়ার, NGO, Bangladesh">
    <meta name="author" content="দ্বীনের আলো">
    <meta property="og:title" content="{{ $pageTitle ?? 'দ্বীনের আলো' }}">
    <meta property="og:description" content="মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে।">
    <meta property="og:type" content="organization">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <title>@yield('title') - দ্বীনের আলো</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&family=Noto+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important; }
        :root {
            --bg: #f8f9fa;
            --fg: #1a1a2e;
            --emerald: #22c55e;
            --emerald-dark: #16a34a;
            --gold: #f59e0b;
            --gold-dark: #d97706;
            --charcoal: #1a1a2e;
        }
        .font-bangla { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif; }
        .bg-emerald { background-color: #22c55e; }
        .bg-emerald-dark { background-color: #16a34a; }
        .text-emerald { color: #22c55e; }
        .text-emerald-dark { color: #16a34a; }
        .fab-button {
            position: fixed; bottom: 24px; right: 24px; width: 56px; height: 56px;
            border-radius: 50%; background: linear-gradient(135deg, #22c55e, #16a34a);
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.3);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 1000;
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .fab-button.show { opacity: 1; visibility: visible; }
        .fab-button:hover { transform: translateY(-2px); box-shadow: 0 6px 25px rgba(34, 197, 94, 0.4); }
        @yield('styles')
    </style>
</head>
<body class="bg-[#f8f9fa]">

    <!-- Header / Navbar -->
    <header class="bg-gray-900 text-white sticky top-0 z-50 backdrop-blur-sm border-b border-white/10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-emerald-400 font-bangla">দ্বীনের আলো</a>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-8">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">হোম</a></li>
                    <li><a href="{{ route('activities') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">কার্যক্রমসমূহ</a></li>
                    <li><a href="{{ route('programs') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">প্রোগাম</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">সম্পর্কে</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">ব্লগ</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">গ্যালারি</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-emerald-400 font-bangla">যোগাযোগ</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-3">
                <a href="{{ route('donation.create') }}" class="bg-emerald text-white px-5 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors font-bangla">
                    দান করুন
                </a>
                <button class="md:hidden text-white p-2" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden absolute top-full left-0 right-0 bg-gray-900 border-t border-white/10">
            <ul class="flex flex-col space-y-4 px-8 py-4">
                <li><a href="{{ route('home') }}" class="text-white hover:text-emerald-400 font-bangla">হোম</a></li>
                <li><a href="{{ route('activities') }}" class="text-white hover:text-emerald-400 font-bangla">কার্যক্রমসমূহ</a></li>
                <li><a href="{{ route('programs') }}" class="text-white hover:text-emerald-400 font-bangla">প্রোগাম</a></li>
                <li><a href="{{ route('about') }}" class="text-white hover:text-emerald-400 font-bangla">সম্পর্কে</a></li>
                <li><a href="{{ route('blog.index') }}" class="text-white hover:text-emerald-400 font-bangla">ব্লগ</a></li>
                <li><a href="{{ route('gallery.index') }}" class="text-white hover:text-emerald-400 font-bangla">গ্যালারি</a></li>
                <li><a href="{{ route('contact') }}" class="text-white hover:text-emerald-400 font-bangla">যোগাযোগ</a></li>
                <li><a href="{{ route('volunteer.create') }}" class="text-white hover:text-emerald-400 font-bangla">স্বেচ্ছাসেবক</a></li>
                <li><a href="{{ route('membership.create') }}" class="text-white hover:text-emerald-400 font-bangla">সদস্যতা</a></li>
                <li><a href="{{ route('zakat') }}" class="text-white hover:text-emerald-400 font-bangla">যাকাত</a></li>
                <li><a href="{{ route('donation.create') }}" class="text-emerald font-medium font-bangla">দান করুন</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold text-emerald-400 mb-6 font-bangla">দ্বীনের আলো</h3>
                    <p class="text-gray-400 text-sm font-bangla">মানুষের পাশে, আলোর পথে। আমরা বাংলাদেশের দরিদ্র ও পিছড়া সম্প্রদায়সমূহের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা এবং আত্মনির্ভরতার জন্য কাজ করে।</p>
                </div>
                
                <div>
                    <h3 class="text-xl font-medium mb-6 font-bangla">দ্রুত লিংক</h3>
                    <ul class="space-y-3 text-gray-400 text-sm font-bangla">
                        <li><a href="{{ route('activities') }}" class="hover:text-emerald-400">কার্যক্রমসমূহ</a></li>
                        <li><a href="{{ route('programs') }}" class="hover:text-emerald-400">প্রোগাম</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-400">সম্পর্কে</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-emerald-400">ব্লগ</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-emerald-400">গ্যালারি</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-emerald-400">যোগাযোগ</a></li>
                        <li><a href="{{ route('donation.create') }}" class="hover:text-emerald-400">দান করুন</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-medium mb-6 font-bangla">প্রোগ্রাম</h3>
                    <ul class="space-y-3 text-gray-400 text-sm font-bangla">
                        <li><a href="{{ route('zakat') }}" class="hover:text-emerald-400">যাকাত ক্যালকুলেটর</a></li>
                        <li><a href="{{ route('volunteer.create') }}" class="hover:text-emerald-400">স্বেচ্ছাসেবক</a></li>
                        <li><a href="{{ route('membership.create') }}" class="hover:text-emerald-400">সদস্যতা</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-medium mb-6 font-bangla">যোগাযোগ</h3>
                    <address class="text-gray-400 text-sm font-bangla not-italic">
                        <p>📍 ঢাকা, বাংলাদেশ</p>
                        <p>📞 +880 1712345678</p>
                        <p>📧 info@annusra.org</p>
                    </address>
                    <div class="mt-6 flex space-x-4">
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.482v-9.294H9.692V11.01h3.118V8.414c0-3.1 1.894-4.788 4.66-4.788 1.34 0 2.48.103 2.48.103v2.87h-1.382c-1.378 0-1.832.86-1.832 1.76v2.31h3.07l-.4 2.53h-2.67V24H22.675C23.4 24 24 23.4 24 22.676V1.326C24 .6 23.4 0 22.675 0z"></path></svg>
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-.154 2.218-.98v-.001c.38-.694.533-1.479.533-2.314a8.625 8.625 0 00-.006-1.625c.819-.158 1.575-.38 2.23-.707a8.58 8.58 0 01-2.72 3.152c-.763-.831-1.818-1.372-3.023-1.372h-.03c-1.325 0-2.48 1.04-3.088 2.5 0 .281.034.557.1.831-3.091-.666-5.847-1.744-8.295-3.057a8.475 8.475 0 00-1.018 4.198c0 2.914 1.528 5.474 3.895 6.876a8.5 8.5 0 01-3.04-1.358c-.02 4.074 2.953 7.458 6.928 8.248a8.55 8.55 0 01-2.97.9c-.086 0-.17-.004-.253-.004 0 0 .003 0 .003.003 0 0 .003 0 .003-.003a8.497 8.497 0 006.865 3.08 8.6 8.6 0 01-5.47 1.882c-.35 0-.697-.021-1.04-.063 1.98 3.286 4.42 5.717 7.24 7.145a8.57 8.57 0 01-6.305 4.49c-1.016 0-2.01-.177-2.986-.512A12.06 12.06 0 0023.954 4.569z"></path></svg>
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04c-.58.04-1.14.16-1.68.32-.62.19-1.17.47-1.65.82-.48.35-.87.78-1.18 1.27C7.22 5.03 6.95 5.6 6.72 6.22c-.19.5-.34 1.02-.43 1.56a8.5 8.5 0 008.45 9.72c.5-.01.99-.14 1.45-.41.46-.27.83-.67 1.08-1.15.28-.52.43-1.09.41-1.67-.01-.58-.16-1.14-.42-1.65a3.85 3.85 0 00-.88-1.25 3.85 3.85 0 00-1.25-.88c-.51-.26-1.07-.42-1.65-.4-.58-.01-1.15.11-1.68.34zM12 0C7.58 0 4 3.58 4 8c0 3.03 1.54 5.79 3.98 7.53l-.03.22C7.82 16.54 7.7 17.4 7.7 18.26c0 1.56.52 2.97 1.38 4.08l.04.03C7.35 23.26 8.56 24 10 24h4c1.44 0 2.66-.74 3.4-1.87l.03-.03c.86-1.11 1.38-2.52 1.38-4.08 0-.86-.12-1.72-.33-2.55 2.55-1.72 4.18-4.68 4.18-8.22C20 3.58 16.42 0 12 0z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm font-bangla mb-4 md:mb-0">&copy; 2026 দ্বীনের আলো। সমস্ত অধিকার সংরক্ষিত।</p>
                <div class="flex space-x-6 md:space-x-8">
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm font-bangla">Privacy Policy</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm font-bangla">Terms & Conditions</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm font-bangla">Refund Policy</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm font-bangla">Donation Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- F.A.B (Floating Action Button) - Scroll to Top -->
    <button id="fab" class="fab-button" aria-label="Scroll to top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 19V5"></path>
            <path d="M5 12l7-7 7 7"></path>
        </svg>
    </button>

    <!-- JavaScript -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('block');
        }
        
        const fab = document.getElementById('fab');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                fab.classList.add('show');
            } else {
                fab.classList.remove('show');
            }
        });
        fab.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
    @yield('scripts')
</body>
</html>
