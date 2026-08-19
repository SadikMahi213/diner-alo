<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দিনের আলো - মানববিদ্বানদের জন্য আলো</title>
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
            --emerald-bg: #ecfdf5;
            --gold-bg: #fffbeb;
        }
        
        .bengali { font-family: 'Noto Sans Bengali', 'Noto Sans', sans-serif; }
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
    </style>
</head>
<body class="bg-bg font-bg">
    
    <!-- Header -->
    <header class="bg-gray-900 text-white sticky top-0 z-50 backdrop-blur-sm border-b border-white/10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-emerald-400 bengali">দিনের আলো</h1>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-8">
                    <li><a href="#hero" class="text-gray-300 hover:text-emerald-400">হোম</a></li>
                    <li><a href="#activities" class="text-gray-300 hover:text-emerald-400">কার্যক্রম</a></li>
                    <li><a href="#projects" class="text-gray-300 hover:text-emerald-400">চলমান প্রকল্প</a></li>
                    <li><a href="#about" class="text-gray-300 hover:text-emerald-400">সম্পর্কে</a></li>
                    <li><a href="#contact" class="text-gray-300 hover:text-emerald-400">যোগাযোগ</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-3">
                <a href="#donate" class="bg-emerald text-white px-5 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors">
                    দান করুন
                </a>
                <button class="md:hidden text-white p-2" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:block absolute top-full left-0 right-0 bg-gray-900 padding-8">
            <ul class="flex flex-col space-y-4 px-8">
                <li><a href="#hero" class="text-white">হোম</a></li>
                <li><a href="#activities" class="text-white">কার্যক্রম</a></li>
                <li><a href="#projects" class="text-white">চলমান প্রকল্প</a></li>
                <li><a href="#about" class="text-white">সম্পর্কে</a></li>
                <li><a href="#contact" class="text-white">যোগাযোগ</a></li>
                <li><a href="#donate" class="text-emerald font-medium">দান করুন</a></li>
            </ul>
        </div>
    </header>
 
    <!-- Hero Section -->
    <section id="hero" class="relative min-h-[600px] bg-bg overflow-hidden">
        <div class="absolute inset-0">
            <!-- Background overlay with subtle pattern -->
            <div class="absolute inset-0 bg-gradient-to-b from-bg to-gray-50"></div>
        </div>
        <div class="relative inset-0 flex items-center justify-center text-center padding-8">
            <div class="max-w-5xl mx-auto">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600 mb-4 bengali">
                    আপনার ছোট্ট সহায়তাই হতে পারে কারো জীবনের নতুন আলো
                </p>
                <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-2xl mx-auto bengali">
                    দিনের আলো মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে।
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#donate" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg">
                        দান করুন
                    </a>
                    <a href="#activities" class="bg-white text-emerald border-emerald-400 px-6 py-3 rounded-full font-medium hover:bg-emerald-50 transition-colors text-lg">
                        আমাদের কার্যক্রম দেখুন
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative element -->
        <div class="absolute -bottom-6 right-0 w-96 h-96 bg-emerald-100 rounded-full opacity-30 blur-3xl"></div>
    </section>
 
    <!-- Trust Strip -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-3 gap-8 max-w-7xl mx-auto">
                <!-- Trust Card 1 -->
                <div class="bg-white rounded-xl p-6 text-center border-l-4 border-emerald-500 hover-transition">
                    <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-emerald-600 mb-2 bengali">নিরাপদ অনুদান</h3>
                    <p class="text-gray-600 text-sm">আমাদের transport system fully encrypted এবং audit logged。</p>
                </div>
                
                <!-- Trust Card 2 -->
                <div class="bg-white rounded-xl p-6 text-center border-l-4 border-gold-500 hover-transition">
                    <div class="w-12 h-12 mx-auto bg-gold-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gold-600 mb-2 bengali">স্বচ্ছ কার্যক্রম</h3>
                    <p class="text-gray-600 text-sm">বছরগত ₹100 মিলিয়ন হতে হবে شفاف নklarity সহamtribute carried out.</p>
                </div>
                
                <!-- Trust Card 3 -->
                <div class="bg-white rounded-xl p-6 text-center border-l-4 border-emerald-500 hover-transition">
                    <div class="w-12 h-12 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-emerald-600 mb-2 bengali">সরাসরি মানুষের পাশে</h3>
                    <p class="text-gray-600 text-sm">১০০% চুক্তিportion of every donation goes directly to beneficiaries.</p>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Impact / Statistics -->
    <section class="py-16 bg-bg">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover-transition">
                    <div class="text-5xl md:text-6xl font-bold text-emerald-600 mb-2 bengali">10,000+</div>
                    <div class="text-gray-600 text-sm mb-2 bengali">উপকারভোগী</div>
                    <p class="text-emerald-500 text-sm">Complete beneficiary reach</p>
                </div>
                
                <!-- Stat Card 2 -->
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover-transition">
                    <div class="text-5xl md:text-6xl font-bold text-gold-600 mb-2 bengali">50+</div>
                    <div class="text-gray-600 text-sm mb-2 bengali">চলমান প্রকল্প</div>
                    <p class="text-gold-500 text-sm">Active development projects</p>
                </div>
                
                <!-- Stat Card 3 -->
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover-transition">
                    <div class="text-5xl md:text-6xl font-bold text-emerald-600 mb-2 bengali">1,000+</div>
                    <div class="text-gray-600 text-sm mb-2 bengali">সেচ্ছাসেবক</div>
                    <p class="text-emerald-500 text-sm">Volunteer strength</p>
                </div>
                
                <!-- Stat Card 4 -->
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover-transition">
                    <div class="text-5xl md:text-6xl font-bold text-gold-600 mb-2 bengali">25+</div>
                    <div class="text-gray-600 text-sm mb-2 bengali">জেলা</div>
                    <p class="text-gold-500 text-sm">Coverage across districts</p>
                </div>
            </div>
        </div>
    </section>
 
    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 bengali">
                        আমাদের সম্পর্কে
                    </h2>
                    <p class="text-gray-600 text-lg mb-6 bengali">
                        দিনের আলো মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে। আমরাregistered nonprofitorganization যারা বাংলাদেশের underserved communitieschildren, women, এবং elderlypeople সাহায্য করার জন্য committed।
                    </p>
                    <p class="text-gray-600 text-lg mb-8 bengali">
                        আমাদের কাজের মূল উদ্দেশ্য হলো_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_--_----
                    </p>
                    <a href="#!" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors text-lg">
                        আরো জানুন
                    </a>
                </div>
                <div class="relative">
                    <!-- Placeholder for about image -->
                    <div class="relative h-[400px] w-full rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-100 to-gray-100">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-gray-500 text-lg">About Image Placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Our Activities -->
    <section id="activities" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 bengali">
                        আমাদের কার্যক্রম
                    </h2>
                    <p class="text-gray-600 text-lg bengali">
                        আমাদের বিভিন্ন সার্ভিস এবং প্রোগ্রামের মাধ্যমে লক্ষों Bengali lives improve।
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Education -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg hover:border-emerald-200 transition-all">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-600 mb-3 bengali">শিক্ষা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm bengali">
                            <li>শিক্ষাবৃত্তি</li>
                            <li>শিক্ষা উপকরণ</li>
                            <li>সুবিধাবঞ্চিত শিশুদের শিক্ষা</li>
                            <li>কারিগরি প্রশিক্ষণ</li>
                        </ul>
                        <p class="text-emerald-500 text-sm">8,000+ শিক্ষার্থী benefited</p>
                    </div>
                    
                    <!-- Food -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg hover:border-emerald-200 transition-all">
                        <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6m4-2v6l4-2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5m-.346-5.05a2 2 0 012.554 0L19.7 7.05a2 2 0 012.86 0l2.308 1.795c.681.52.694 1.67.023 2.309l-2.293 6.287c-.379.93-1.33.98-2.22.6l-5.348-1.517L7.05 22.89a2 2 0 01-2.86 0l-2.308-1.795c-.681-.53-.695-1.68.023-2.309l2.293-6.287c.851-1.23 1.494-1.33 2.22-.6L5.34 15.05a2 2 0 012.554 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gold-600 mb-3 bengali">খাদ্য ও মানবিক সহায়তা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm bengali">
                            <li>খাদ্য বিতরণ</li>
                            <li>জরুরি ত্রাণ</li>
                            <li>রমজান খাদ্য সহায়তা</li>
                            <li>ঈদ সামগ্রী</li>
                        </ul>
                        <p class="text-gold-500 text-sm">500,000+ প identyfikators served</p>
                    </div>
                    
                    <!-- Medicine -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg hover:border-emerald-200 transition-all">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m0 0h1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-600 mb-3 bengali">চিকিৎসা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm bengali">
                            <li>ফ্রি মেডিকেল ক্যাম্প</li>
                            <li>ওষুধ সহায়তা</li>
                            <li>দরিদ্র রোগী সহায়তা</li>
                        </ul>
                        <p class="text-emerald-500 text-sm">100,000+ মেডিকেল ট Bangladesh</p>
                    </div>
                    
                    <!-- Empowerment -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg hover:border-emerald-200 transition-all">
                        <div class="w-12 h-12 bg-gold-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gold-600 mb-3 bengali">আত্মনির্ভরতা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm bengali">
                            <li>কর্মসংস্থান সহায়তা</li>
                            <li>উদ্যোক্তা সহায়তা</li>
                            <li>দক্ষতা প্রশিক্ষণ</li>
                        </ul>
                        <p class="text-gold-500 text-sm">2,000+ স্বেচ্ছাসেবক trained</p>
                    </div>
                    
                    <!-- Emergency -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg hover:border-emerald-200 transition-all">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 9v2m-6-3h12a2 2 0 002-2v-4.586a2 2 0 00-1.414-1.414L9 15.414a2 2 0 00-1.414 1.414m0 0H5m2 6l3 3m-3-3l-3-3m0 0l3-3m3 3l-3 3"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-600 mb-3 bengali">দুর্যোগ সহায়তা</h3>
                        <ul class="space-y-2 text-gray-600 text-sm bengali">
                            <li>বন্যা</li>
                            <li>ঘূর্ণিঝড়</li>
                            <li>শীতকালীন সহায়তা</li>
                            <li>জরুরি ত্রাণ</li>
                        </ul>
                        <p class="text-emerald-500 text-sm">50,000+ emergency families helped</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Current Projects -->
    <section id="projects" class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-emerald-600 mb-6 bengali">
                        চলমান প্রকল্প
                    </h2>
                    <p class="text-gray-600 text-lg bengali">
                        আমাদের চলমান প্রকল্পগুলো এবং সহায়তার প্রেক্ষাপট
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Project Card 1 -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-emerald-600 mb-2 bengali">শীতবস্ত্র বিতরণ ২০২৬</h3>
                                <p class="text-gray-500 text-sm bengali">ষষ্ঠ মাস ধরে winter clothing distribution program</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-emerald-600 mb-1 bengali">৳6,75,000</p>
                                <p class="text-gray-500 text-sm bengali>/ ৳10,00,000</p>
                            </div>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full mt-4">
                            <div class="h-full bg-emerald-600 rounded-full transition-width" style="width: 67.5%;"></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3 bengali">67.5% progressed</p>
                        <div class="flex justify-between text-emerald-600 text-sm bengali">
                            <span>Target: ৳10,00,000</span>
                            <span>Collected: ৳6,75,000</span>
                        </div>
                        <a href="#!" class="text-emerald-600 font-medium hover-text-emerald-700 transition-colors">সহায়তা করুন</a>
                    </div>
                    
                    <!-- Project Card 2 -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gold-600 mb-2 bengali">শিক্ষা scholarship ২০২৬</h3>
                                <p class="text-gray-500 text-sm bengali">একademia scholarship program for meritorious students</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gold-600 mb-1 bengali">৳2,50,000</p>
                                <p class="text-gray-500 text-sm bengali>/ ৳5,00,000</p>
                            </div>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full mt-4">
                            <div class="h-full bg-gold-600 rounded-full transition-width" style="width: 50%;"></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3 bengali">50% progressed</p>
                        <div class="flex justify-between text-gold-600 text-sm bengali">
                            <span>Target: ৳5,00,000</span>
                            <span>Collected: ৳2,50,000</span>
                        </div>
                        <a href="#!" class="text-gold-600 font-medium hover-text-gold-700 transition-colors">সহায়তা করুন</a>
                    </div>
                    
                    <!-- Project Card 3 -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-transition transform hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-emerald-600 mb-2 bengali">ঋণমুক্তিকরণ programme</h3>
                                <p class="text-gray-500 text-sm bengali">Microfinance initiative for women entrepreneurs</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-emerald-600 mb-1 bengali">৳1,50,000</p>
                                <p class="text-gray-500 text-sm bengali>/ ৳3,00,000</p>
                            </div>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full mt-4">
                            <div class="h-full bg-emerald-600 rounded-full transition-width" style="width: 50%;"></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3 bengali">50% progressed</p>
                        <div class="flex justify-between text-emerald-600 text-sm bengali">
                            <span>Target: ৳3,00,000</span>
                            <span>Collected: ৳1,50,000</span>
                        </div>
                        <a href="#!" class="text-emerald-600 font-medium hover-text-emerald-700 transition-colors">সহায়তা করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Donation CTA -->
    <section id="donate" class="py-24 bg-emerald-dark">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 bengali">
                    দান করুন এবং জীবনের আলো বানান
                </h2>
                <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto bengali">
                    আপনার ছোট্ট সহায়তা কারোর জिंदगी permanently change করতে পারে। প্রতিটি donation meaningful difference তৈরি করে।
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto">
                    <div>
                        <h3 class="text-xl font-medium mb-4 bengali>দানকার shading</h3>
                        <div class="space-y-2">
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳500
                            </button>
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳1,000
                            </button>
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳2,500
                            </button>
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳5,000
                            </button>
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">
                                ৳10,000
                            </button>
                            <button class="w-full py-3 px-4 bg-white text-emerald-600 font-medium rounded-full hover:bg-emerald-100 transition-colors text-sm">Custom Amount</button>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-medium mb-4 bengali>পেমেন্ট মেথড</h3>
                        <div class="space-y-3">
                            <div class="bg-white px-4 py-3 rounded-lg bengali">
                                <p class="text-emerald-400 font-medium">bKash</p>
                                <p class="text-gray-300 text-sm">01712345678</p>
                            </div>
                            <div class="white px-4 py-3 rounded-lg bengali">
                                <p class="text-gold-400 font-medium">Nagad</p>
                                <p class="text-gray-300 text-sm">01712345678</p>
                            </div>
                            <div class="bg-white px-4 py-3 rounded-lg bengali">
                                <p class="text-gold-400 font-medium">Rocket</p>
                                <p class="text-gray-300 text-sm">01712345678</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#!" class="mt-8 bg-white text-emerald-600 px-8 py-3 rounded-full font-medium hover:bg-emerald-100 transition-colors text-lg">
                    donation পেইজে যাওয়
                </a>
            </div>
        </div>
    </section>
 
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Column 1 -->
                <div>
                    <h3 class="text-2xl font-bold text-emerald-400 mb-6 bengali">দিনের আলো</h3>
                    <p class="text-gray-400 text-sm bengali">মানুষের পাশে, আলোর পথে। আমরা সাড়া দরিদ্র এবং benachid communities সাহায্য করার জন্য কাজ করে。</p>
                </div>
                
                <!-- Column 2 -->
                <div>
                    <h3 class="text-xl font-medium mb-6 bengali">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400 text-sm bengali">
                        <li><a href="#!" hover:text-emerald-400</a></li>
                        <li><a href="#activities" hover:text-emerald-400</a></li>
                        <li><a href="#projects" hover:text-emerald-400</a></li>
                        <li><a href="#about" hover:text-emerald-400</a></li>
                        <li><a href="#contact" hover:text-emerald-400</a></li>
                    </ul>
                </div>
                
                <!-- Column 3 -->
                <div>
                    <h3 class="text-xl font-medium mb-6 bengali">Programs</h3>
                    <ul class="space-y-3 text-gray-400 text-sm bengali">
                        <li><a href="#!" hover:text-emerald-400</a></li>
                        <li><a href="#!" hover:text-emerald-400</a></li>
                        <li><a href="#!" hover:text-emerald-400</a></li>
                        <li><a href="#!" hover:text-emerald-400</a></li>
                    </ul>
                </div>
                
                <!-- Column 4 -->
                <div>
                    <h3 class="text-xl font-medium mb-6 bengali">Contact</h3>
                    <address class="text-gray-400 text-sm bengali">
                        <p>📍 Dhaka, Bangladesh</p>
                        <p>📞 +880 1712345678</p>
                        <p>📧 info@dineralo.org</p>
                    </address>
                    <div class="mt-6">
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3m0 0V7a1 1 0 011-1h2a1 1 0 011 1v4m0-3h4a1 1 0 011 1v1a1 1 0 11-2 0v-1m-4-4h4"></path></svg>
                            Facebook
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors ml-4">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7zM12 20a8 8 0 00-8 8h16a8 8 0 00-8-8z"></path></svg>
                            Twitter
                        </a>
                        <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors ml-4">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.261 2.261a5.992 5.992 0 018.482 0M15.547 15.547l6.057 6.057m0-1.321l-6.057-6.057m6.057 6.057-3.028-3.028m3.394-3.394L15.547 15.547"/></svg>
                            Instagram
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Bottom footer -->
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm bengali">&copy; 2026 দিনের আলো। সমস্ত অধিকার সংরক্ষিত。</p>
                <div class="flex space-x-6 md:space-x-8">
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Privacy Policy</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Terms & Conditions</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Refund Policy</a>
                    <a href="#!" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Donation Policy</a>
                </div>
            </div>
        </div>
    </footer>
 
    <!-- Mobile Menu Toggle Script -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('block');
        }
    </script>
</body>
</html>