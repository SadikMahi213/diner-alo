<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="আন-নুসরা ফাউন্ডেশন - মানব পরিবার পরিচালিত গাণসিয়কারিত্বিক সংস্থা। বাংলাদেশের দারিদ্র এবং সামাজিকভাবে পিছড়া communities সাহায্য করে।">
    <meta name="keywords" content="আন-নুসরা ফাউন্ডেশন, বাঙালি, মানবিক, চ্যারিটি, দান, Zakat, খাদ্য, শিক্ষা, চিকিৎসা, ভোলান্টিয়ার, NGO, Bangladesh">
    <meta name="author" content="আন-নুসরা ফাউন্ডেশন">
    <meta property="og:title" content="আন-নুসরা ফাউন্ডেশন">
    <meta property="og:description" content="মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে।">
    <meta property="og:type" content="organization">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url('/') }}">
    <title>আন-নুসরা ফাউন্ডেশন - মানুষের পাশে, আলোর পথে</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&family=Noto+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif !important;
        }
        :root {
            --bg: #f8f9fa;
            --fg: #1a1a2e;
            --muted: #6b7280;
            --emerald: #22c55e;
            --emerald-dark: #16a34a;
            --gold: #f59e0b;
            --gold-dark: #d97706;
            --charcoal: #1a1a2e;
            --card: #ffffff;
            --border: #e5e7eb;
            --bg-primary: #16a34a;
            --primary: #15803d;
            --primary-hover: #14532d;
            --text-white: #ffffff;
        }
        
        .font-bangla { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif; }
        .bg-emerald { background-color: #22c55e; }
        .bg-emerald-dark { background-color: #16a34a; }
        .bg-gold { background-color: #f59e0b; }
        .bg-gold-dark { background-color: #d97706; }
        .bg-charcoal { background-color: #1a1a2e; }
        .text-emerald { color: #22c55e; }
        .text-emerald-dark { color: #16a34a; }
        .text-gold { color: #f59e0b; }
        .text-charcoal { color: #1a1a2e; }
        .text-muted { color: #6b7280; }
        .hover-emerald:hover { background-color: #16a34a; border-color: #16a34a; }
        .hover-gold:hover { background-color: #d97706; border-color: #d97706; }
        .progress-bg { background-color: #e5e7eb; }
        .progress-fill { height: 0.25rem; border-radius: 0.25rem; }
        
        /* FAB styles from HTML */
        .fab-button {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .fab-button.show { opacity: 1; visibility: visible; }
        .fab-button:hover { transform: translateY(-2px); box-shadow: 0 6px 25px rgba(34, 197, 94, 0.4); }
    </style>
</head>
<body class="bg-bg font-bg">
    
    <!-- Header / Navbar -->
    <header class="bg-gray-900 text-white sticky top-0 z-50 backdrop-blur-sm border-b border-white/10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-emerald-400 bengali font-bangla">আন-নুসরা ফাউন্ডেশন</h1>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-8">
                    <li><a href="#hero" class="text-gray-300 hover:text-emerald-400 font-bangla">হোম</a></li>
                    <li><a href="#activities" class="text-gray-300 hover:text-emerald-400 font-bangla">কার্যক্রম</a></li>
                    <li><a href="#projects" class="text-gray-300 hover:text-emerald-400 font-bangla">প্রকল্প</a></li>
                    <li><a href="#about" class="text-gray-300 hover:text-emerald-400 font-bangla">সম্পর্কে</a></li>
                    <li><a href="#contact" class="text-gray-300 hover:text-emerald-400 font-bangla">যোগাযোগ</a></li>
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
        <div id="mobileMenu" class="hidden md:block absolute top-full left-0 right-0 bg-gray-900 border-t border-white/10">
            <ul class="flex flex-col space-y-4 px-8 py-4">
                <li><a href="#hero" class="text-white hover:text-emerald-400 font-bangla">হোম</a></li>
                <li><a href="#activities" class="text-white hover:text-emerald-400 font-bangla">কার্যক্রম</a></li>
                <li><a href="#projects" class="text-white hover:text-emerald-400 font-bangla">প্রকল্প</a></li>
                <li><a href="#about" class="text-white hover:text-emerald-400 font-bangla">সম্পর্কে</a></li>
                <li><a href="#contact" class="text-white hover:text-emerald-400 font-bangla">যোগাযোগ</a></li>
                <li><a href="{{ route('donation.create') }}" class="text-emerald font-medium font-bangla">দান করুন</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="relative min-h-[600px] bg-bg overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-bg to-gray-50"></div>
        </div>
        <div class="relative inset-0 flex items-center justify-center text-center px-4 py-14 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto mt-24 sm:mt-0">
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 font-bangla">
                    আন-নুসরা ফাউন্ডেশন
                </h1>
                <p class="text-md text-white/90 mb-8 leading-relaxed font-bangla">
                    আমরা একটি অরাজনৈতিক, অলাভজনক, ধর্মীয়, সামাজিক ও মানবকল্যাণমূলক সংস্থা।
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mb-8 justify-center">
                    <a href="{{ route('donation.create') }}" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg font-bangla">
                        দান করুন
                    </a>
                    <a href="#activities" class="bg-white text-emerald border-emerald-400 px-6 py-3 rounded-full font-medium hover:bg-emerald-50 transition-colors text-lg border font-bangla">
                        আমাদের কার্যক্রম দেখুন
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -bottom-6 right-0 w-96 h-96 bg-emerald-100 rounded-full opacity-30 blur-3xl"></div>
    </section>

    <!-- Impact / Statistics -->
    <section class="py-16 bg-bg">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="text-5xl md:text-6xl font-bold text-emerald-600 mb-2 font-bangla">{{ number_format($totalDonors) }}+</div>
                    <div class="text-gray-600 text-sm mb-2 font-bangla">উপকারভোগী</div>
                    <p class="text-emerald-500 text-sm">Complete beneficiary reach</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="text-5xl md:text-6xl font-bold text-gold-600 mb-2 font-bangla">৳{{ number_format($totalDonations) }}</div>
                    <div class="text-gray-600 text-sm mb-2 font-bangla">মোট দান</div>
                    <p class="text-gold-500 text-sm">Total donations collected</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="text-5xl md:text-6xl font-bold text-emerald-600 mb-2 font-bangla">{{ $totalProjects }}+</div>
                    <div class="text-gray-600 text-sm mb-2 font-bangla">চলমান প্রকল্প</div>
                    <p class="text-emerald-500 text-sm">Active development projects</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-sm">
                    <div class="text-5xl md:text-6xl font-bold text-gold-600 mb-2 font-bangla">{{ number_format($totalBeneficiaries) }}+</div>
                    <div class="text-gray-600 text-sm mb-2 font-bangla">সেচ্ছাসেবক</div>
                    <p class="text-gold-500 text-sm">Volunteer strength</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Plans (Monthly) -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">মাসিক অনুদান</h2>
                    <p class="text-gray-600 text-lg font-bangla">নিয়মিত দাতা হয়ে আমাদের স্থায়ী সেবার অংশীদার হোন</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($donationFunds as $fund)
                    <div class="bg-white rounded-2xl p-6 border-2 border-emerald-200 hover:border-emerald-500 transform hover:shadow-lg transition-all">
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-xl flex items-center justify-center mb-5">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4-.89-4-2s1.79-2 4-2 4 .89 4 2-1.79 2-4 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m-8-5c0-2.21 1.79-4 4-4s4 1.79 4 4"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-emerald-600 mb-3 font-bangla">{{ $fund->name }}</h3>
                            <p class="text-gray-700 mb-4 font-bangla">{{ Str::limit($fund->description, 100) }}</p>
                            <div class="text-3xl font-bold text-emerald-600 mb-4 font-bangla">
                                মাসিক ৳{{ number_format($fund->target_amount, 0) }}+
                            </div>
                            <a href="{{ route('donation.create') }}" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors inline-block font-bangla">
                                দান করুন
                            </a>
                        </div>
                    </div>
                    @empty
                    <!-- Empty state: No donation funds available -->
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 font-bangla">এখনও কোনো অনুদান পরিকল্পনা উপলব্ধ নেই।</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Lifetime Membership Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">আজীবন সদস্য</h2>
                    <p class="text-gray-600 text-lg font-bangla">আজীবন সদস্যপদের মাধ্যমে স্থায়ীভাবে মানবসেবার অংশীদার হওয়ুন</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Membership Benefits Card -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 font-bangla">সদস্যপদের সুবিধাসমূহ</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">বিশেষ স্বীকৃতি ও সনদ</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">বার্ষিক রিপোর্ট ও আপডেট</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">অনুষ্ঠানে সরাসরি আমন্ত্রণ</span>
                            </div>
                        </div>
                        <a href="{{ route('membership.create') }}" class="block mt-6 bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-center font-bangla">
                            সদস্যতা নিন
                        </a>
                    </div>
                    
                    <!-- Career Section -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 font-bangla">ক্যারিয়ার</h3>
                        <p class="text-gray-600 mb-4 font-bangla">আমাদের টিমের অংশ হয়ে পেশাদারি দক্ষতা নিয়ে মানবসেবায় যুক্ত হওয়ুন</p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">ফুলটাইম চাকরি</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">পার্টটাইম চাকরি</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">ইন্টার্নশিপ</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path></svg>
                                <span class="text-gray-700 font-bangla">বিশেষ দক্ষতা ভর্ততি</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Activities -->
    <section id="activities" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">আমাদের কার্যক্রম</h2>
                    <p class="text-gray-600 text-lg font-bangla">আমাদের বিভিন্ন সেবা ও প্রোগ্রামের মাধ্যমে লাখো জীবন উন্নত হয়েছে</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">শিক্ষা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>শিক্ষাভিত্তি</li>
                            <li>শিক্ষা উপকরণ</li>
                            <li>সুবিধাভোগী শিশুদের শিক্ষা</li>
                            <li>কারিগরিক প্রশিক্ষণ</li>
                        </ul>
                        <p class="text-emerald-600 text-sm mt-3 font-bangla">8,000+ শিক্ষার্থীর সহায়তা</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-gold-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6m4-2v6l4-2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5m-.346-5.05a2 2 0 012.554 0L19.7 7.05a2 2 0 012.86 0l2.308 1.795c.681.52.694 1.67.023 2.309l-2.293 6.287c-.379.93-1.33.98-2.22.6l-5.348-1.517L7.05 22.89a2 2 0 01-2.86 0l-2.308-1.795c-.681-.53-.695-1.68.023-2.309l2.293-6.287c.851-1.23 1.494-1.33 2.22-.6L5.34 15.05a2 2 0 012.554 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">খাদ্য ও মানবিক সহায়তা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>খাদ্য বিতরণ</li>
                            <li>জরুরি ত্রাণ</li>
                            <li>রমজান খাদ্য সহায়তা</li>
                            <li>ঈদ সামগ্রী বিতরণ</li>
                        </ul>
                        <p class="text-gold-600 text-sm mt-3 font-bangla">500,000+ পরিবারের সহায়তা</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">স্বাস্থ্য সেবা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>ফ্রি মেডিকেল ক্যাম্প</li>
                            <li>ওষুধ সহায়তা</li>
                            <li>দরিদ্র রোগী সহায়তা</li>
                        </ul>
                        <p class="text-emerald-600 text-sm mt-3 font-bangla">100,000+ রোগীর সহায়তা</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-gold-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">আত্মনির্ভরতা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>কর্মসংস্থান সহায়তা</li>
                            <li>উদ্যোগী সহায়তা</li>
                            <li>দক্ষতা প্রশিক্ষণ</li>
                        </ul>
                        <p class="text-gold-600 text-sm mt-3 font-bangla">2,000+ স্বেচ্ছাসেবক প্রশিক্ষণ</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 9v2m-6-3h12a2 2 0 002-2v-4.586a2 2 0 00-1.414-1.414L9 15.414a2 2 0 00-1.414 1.414m0 0H5m2 6l3 3m-3-3l-3-3m0 0l3-3m3 3l-3 3"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">দুর্যোগ সহায়তা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>বন্যা</li>
                            <li>ঘূর্ণিঝড়</li>
                            <li>শীতকালীন সহায়তা</li>
                            <li>জরুরি ত্রাণ</li>
                        </ul>
                        <p class="text-emerald-600 text-sm mt-3 font-bangla">50,000+ পরিবারের সহায়তা</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-gold-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">স্বেচ্ছাসেবক</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>ফিল্ড ভলান্টিয়ার</li>
                            <li>অনলাইন স্বেচ্ছাসেবক</li>
                            <li>বিশেষ দক্ষতা</li>
                        </ul>
                        <p class="text-gold-600 text-sm mt-3 font-bangla">1,000+ সক্রিয় স্বেচ্ছাসেবক</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">পর্যায়ক্রম প্রকল্প</h3>
                        <ul class="space-y-2 text-gray-600 text-sm font-bangla">
                            <li>শিক্ষা স্তরীকরণ</li>
                            <li>খাদ্য সহায়তা</li>
                            <li>স্বাস্থ্য পরিষেবা</li>
                        </ul>
                        <p class="text-emerald-600 text-sm mt-3 font-bangla">25+ জেলায় কার্যক্রম</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Current Projects -->
    <section id="projects" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">চলমান প্রকল্প</h2>
                    <p class="text-gray-600 text-lg font-bangla">আমাদের চলমান প্রকল্পগুলো ও সহায়তার প্রেক্ষাপট</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($featuredProjects as $project)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="h-48 bg-gradient-to-br from-emerald-100 to-gray-100 flex items-center justify-center">
                            @if($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 font-bangla">ছবি এখনও যুক্ত হয়নি</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900 font-bangla">{{ $project->title }}</h3>
                                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bangla">
                                    {{ $project->status === 'running' ? 'চলমান' : ($project->status === 'completed' ? 'সম্পন্ন' : 'আসন্ন') }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 font-bangla line-clamp-2">{{ Str::limit($project->description, 100) }}</p>
                            
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1 font-bangla">
                                    <span class="text-gray-500">Target: ৳{{ number_format($project->target_amount, 0) }}</span>
                                    <span class="text-gray-500">Collected: ৳{{ number_format($project->collected_amount, 0) }}</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full">
                                    <div class="h-full bg-emerald-600 rounded-full" style="width: {{ min(100, $project->progress_percentage) }}%"></div>
                                </div>
                                <p class="text-gray-500 text-xs mt-1 font-bangla">{{ number_format($project->progress_percentage, 1) }}% অগ্রগতি</p>
                            </div>
                            
                            <a href="{{ route('donation.create') }}" class="text-emerald-600 font-medium hover:text-emerald-700 transition-colors font-bangla">
                                এই প্রকল্পে দান করুন
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 font-bangla">এখনও কোনও চলমান প্রকল্প নেই।</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section id="news" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">সর্বশেষ সংবাদ</h2>
                    <p class="text-gray-600 text-lg font-bangla">আমাদের থেকে হালনাগাদ ও আপডেট পেতে থাকুন</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($latestNews as $post)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="h-48 bg-gradient-to-br from-emerald-100 to-gray-100">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400 font-bangla">ছবি এখনও যুক্ত হয়নি</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                @if($post->category)
                                    <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bangla">{{ $post->category->name }}</span>
                                @endif
                                <span class="text-xs text-gray-500 font-bangla">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">{{ Str::limit($post->title, 50) }}</h3>
                            <p class="text-gray-600 text-sm mb-4 font-bangla line-clamp-3">{{ Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-emerald-600 font-medium hover:text-emerald-700 transition-colors font-bangla">
                                আরো পঢ়ুন
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 font-bangla">এখনও কোনো সংবাদ প্রকাশিত হয়নি।</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">আমাদের সম্পর্কে</h2>
                        <p class="text-gray-600 text-lg mb-6 font-bangla">
                            আমরা একটি অরাজনৈতিক, অলাভজনক, ধর্মীয়, সামাজিক ও মানবকল্যাণমূলক সংস্থা। বাংলাদেশের দরিদ্র ও সামাজিকভাবে পিছড়া সম্প্রদায়সমূহের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা এবং আত্মনির্ভরতার জন্য কাজ করে।
                        </p>
                        <p class="text-gray-600 text-lg mb-8 font-bangla">
                            আমাদের মূল লক্ষ্য হলো মানবসেবায় অংশগ্রহণকারী পরিবারগুলোর জীবনের মানোন্নয়ন এবং স্থায়ী পরিবর্তন আনা।
                        </p>
                        <a href="{{ route('about') }}" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg font-bangla">
                            আরও জানুন
                        </a>
                    </div>
                    <div class="relative">
                        <div class="relative h-[400px] w-full rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-100 to-gray-100">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-gray-500 text-lg font-bangla">About Image Placeholder</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation CTA -->
    <section id="donate" class="py-24 bg-emerald-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 font-bangla">দান করুন এবং জীবনের আলো বানান</h2>
                <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto font-bangla">
                    আপনার ছোট্ট সহায়তা কারোর জীবনে চুক্তিকরভাবে পরিবর্তন আনতে পারে। প্রতিটি দানই একটি মানুষের জীবনে আলোর ঝলক জাগায়।
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto">
                    <div>
                        <h3 class="text-xl font-medium mb-4 font-bangla">দানকারীর পরিমাণ</h3>
                        <div class="space-y-2">
                            <button onclick="setAmount(500)" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳500
                            </button>
                            <button onclick="setAmount(1000)" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳1,000
                            </button>
                            <button onclick="setAmount(2500)" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳2,500
                            </button>
                            <button onclick="setAmount(5000)" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳5,000
                            </button>
                            <button onclick="setAmount(10000)" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳10,000
                            </button>
                            <button onclick="document.getElementById('customAmount').value=''" class="donation-btn w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                কাস্টম পরিমাণ
                            </button>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-medium mb-4 font-bangla">পেমেন্ট পদ্ধতি</h3>
                        <div class="space-y-3">
                            <div class="bg-white/10 px-4 py-3 rounded-lg font-bangla">
                                <p class="text-emerald-400 font-medium">bKash</p>
                                <p class="text-gray-300 text-sm">০১৭১২৩৪৫৬৭৮</p>
                            </div>
                            <div class="bg-white/10 px-4 py-3 rounded-lg font-bangla">
                                <p class="text-gold-400 font-medium">Nagad</p>
                                <p class="text-gray-300 text-sm">০১৭১২৩৪৫৬৭৮</p>
                            </div>
                            <div class="bg-white/10 px-4 py-3 rounded-lg font-bangla">
                                <p class="text-gold-400 font-medium">Rocket</p>
                                <p class="text-gray-300 text-sm">০১৭১২৩৪৫৬৭৮</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('donation.create') }}" class="mt-8 bg-white text-emerald-600 px-8 py-3 rounded-full font-medium hover:bg-emerald-100 transition-colors text-lg font-bangla">
                    দানের ফর্মে যান
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 font-bangla">যোগাযোগ</h2>
                    <p class="text-gray-600 text-lg font-bangla">আমাদের সাথে যোগাযোগ করুন</p>
                </div>
                
                <div class="grid lg:grid-cols-2 gap-12">
                    <div>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.982 18.72S18 16 18 13.5A6 6 0 006 7.5c0 3.5-3 5-3 5s3 1.5 3 5A6 6 0 0012 21a6 6 0 006-1.28z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 font-bangla">ঠিজ্ঞান</h3>
                                    <p class="text-gray-600 font-bangla">Dhaka, Bangladesh</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 font-bangla">ইমেল</h3>
                                    <p class="text-gray-600 font-bangla">info@annusra.org</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.087 3.27a1 1 0 01-.54 1.213l-2.16 1.08a14.014 14.014 0 000 5.236l2.16 1.08a1 1 0 01.54 1.213L9.22 19.316a1 1 0 01-.948.684H5a2 2 0 01-2-2V5z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 font-bangla">ফোন</h3>
                                    <p class="text-gray-600 font-bangla">+880 1712345678</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 font-bangla">আমাদের বার্তা রক্ষা করুন</h3>
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <input type="text" name="name" required placeholder="আপনার নাম" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 font-bangla">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="email" name="email" required placeholder="ইমেল" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 font-bangla">
                                <input type="tel" name="phone" placeholder="ফোন" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 font-bangla">
                            </div>
                            <input type="text" name="subject" placeholder="বিষয়" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 font-bangla">
                            <textarea name="message" required rows="5" placeholder="বার্তা" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 font-bangla"></textarea>
                            <button type="submit" class="w-full bg-emerald text-white py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors font-bangla">
                                বার্তা পাঠান
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold text-emerald-400 mb-6 font-bangla">আন-নুসরা ফাউন্ডেশন</h3>
                    <p class="text-gray-400 text-sm font-bangla">মানুষের পাশে, আলোর পথে। আমরা বাংলাদেশের দরিদ্র ও পিছড়া সম্প্রদায়সমূহের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা এবং আত্মনির্ভরতার জন্য কাজ করে।</p>
                </div>
                
                <div>
                    <h3 class="text-xl font-medium mb-6 font-bangla">দ্রুত লিংক</h3>
                    <ul class="space-y-3 text-gray-400 text-sm font-bangla">
                        <li><a href="#!" class="hover:text-emerald-400">ব্যক্তিগত তথ্য</a></li>
                        <li><a href="#activities" class="hover:text-emerald-400">কার্যক্রম</a></li>
                        <li><a href="#projects" class="hover:text-emerald-400">প্রকল্প</a></li>
                        <li><a href="#about" class="hover:text-emerald-400">সম্পর্কে</a></li>
                        <li><a href="#contact" class="hover:text-emerald-400">যোগাযোগ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-medium mb-6 font-bangla">প্রোগ্রাম</h3>
                    <ul class="space-y-3 text-gray-400 text-sm font-bangla">
                        <li><a href="#!" class="hover:text-emerald-400">শিক্ষা</a></li>
                        <li><a href="#!" class="hover:text-emerald-400">খাদ্য সহায়তা</a></li>
                        <li><a href="#!" class="hover:text-emerald-400">চিকিৎসা</a></li>
                        <li><a href="#!" class="hover:text-emerald-400">স্বেচ্ছাসেবক</a></li>
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
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-.154 2.218-.98v-.001c.38-.694.533-1.479.533-2.314a8.625 8.625 0 00-.006-1.625c.819-.158 1.575-.38 2.23-.707a8.58 8.58 0 01-2.72 3.152c-.763-.831-1.818-1.372-3.023-1.372h-.03c-1.325 0-2.48 1.04-3.088 2.5 0 .281.034.557.1.831-3.091-.666-5.847-1.744-8.295-3.057a8.475 8.475 0 00-1.018 4.198c0 2.914 1.528 5.474 3.895 6.876a8.5 8.5 0 01-3.04-1.358c-.02 4.074 2.953 7.458 6.928 8.248a8.55 8.55 0 01-2.97.9c-.086 0-.17-.004-.253-.004 0 0 .003 0 .003.003 0 0 .003 0 .003-.003a8.497 8.497 0 006.865 3.08 8.6 8.6 0 01-5.47 1.882c-.35 0-.697-.021-1.04-.063 1.98 3.286 4.42 5.717 7.24 7.145a8.57 8.57 0 01-6.305 4.49c-1.016 0-2.01-.177-2.986-.512A12.06 12.06 0 0023.954 4.569L23.954 4.569zM12 23.99c-2.58 0-5.02-.682-7.04-1.892 0 0-.04.025-.06.038a8.5 8.5 0 006.14 2.667 8.5 8.5 0 006.18-2.33c.03-.02-.01-.037-.02-.08zM2.006 12.01c0-3.26 1.45-6.18 3.83-8.28A9.243 9.243 0 012.87 1.995a8.58 8.58 0 00-.01 3.622 8.46 8.46 0 003.42 5.716 8.51 8.51 0 01-.99.886z"></path></svg>
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.337 0 0 5.337 0 12s5.337 12 12 12 12-5.337 12-12S18.663 0 12 0zm4.875 11.25c0 .938-.75 1.75-1.668 1.75h-1.077v3.248c0 .414-.336.75-.75.75h-1.5c-.414 0-.75-.336-.75-.75V13h-1.125c-.918 0-1.668-.812-1.668-1.75v-2.5c0-.938.75-1.75 1.668-1.75H13.5V5.998c0-.414.336-.75.75-.75h1.5c.414 0 .75.336.75.75v1.748h1.077c.918 0 1.668.812 1.668 1.75v2.5z"></path></svg>
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04c-.58.04-1.14.16-1.68.32-.62.19-1.17.47-1.65.82-.48.35-.87.78-1.18 1.27C7.22 5.03 6.95 5.6 6.72 6.22c-.19.5-.34 1.02-.43 1.56a8.5 8.5 0 008.45 9.72c.5-.01.99-.14 1.45-.41.46-.27.83-.67 1.08-1.15.28-.52.43-1.09.41-1.67-.01-.58-.16-1.14-.42-1.65a3.85 3.85 0 00-.88-1.25 3.85 3.85 0 00-1.25-.88c-.51-.26-1.07-.42-1.65-.4-.58-.01-1.15.11-1.68.34zM12 0C7.58 0 4 3.58 4 8c0 3.03 1.54 5.79 3.98 7.53l-.03.22C7.82 16.54 7.7 17.4 7.7 18.26c0 1.56.52 2.97 1.38 4.08l.04.03C7.35 23.26 8.56 24 10 24h4c1.44 0 2.66-.74 3.4-1.87l.03-.03c.86-1.11 1.38-2.52 1.38-4.08 0-.86-.12-1.72-.33-2.55 2.55-1.72 4.18-4.68 4.18-8.22C20 3.58 16.42 0 12 0z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm font-bangla mb-4 md:mb-0">&copy; 2026 আন-নুসরা ফাউন্ডেশন। সমস্ত অধিকার সংরক্ষিত।</p>
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
        
        function setAmount(amount) {
            document.getElementById('customAmount').value = amount;
        }
        
        // FAB scroll to top
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
</body>
</html>