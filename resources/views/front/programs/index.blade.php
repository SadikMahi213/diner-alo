@extends('layouts.front')
@section('title', 'প্রোগাম')
@section('content')

    <!-- Page Hero -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-50/40 via-white to-white py-16 md:py-20">
        <div class="absolute inset-0 opacity-30 pointer-events-none">
            <div class="absolute top-20 left-10 w-96 h-96 bg-gradient-to-br from-blue-100/40 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-gradient-to-tr from-amber-100/40 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(32,166,67,0.2) 1px, transparent 0); background-size: 24px 24px;"></div>
        </div>
        <div class="relative container mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 border border-emerald-200 text-emerald-700 mb-5">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                মানুষের সেবায় নিরলস
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-5 font-bangla leading-tight">
                আমাদের <span class="text-primary">স্থায়ী প্রকল্পসমূহ</span>
            </h1>
            <p class="text-gray-500 text-base md:text-lg max-w-2xl mx-auto font-bangla leading-relaxed">
                আন-নুসরা ফাউন্ডেশন কেবল সাময়িক সহায়তা নয়, বরং মানুষের জীবনমান উন্নয়নে টেকসই ও দীর্ঘমেয়াদী পরিকল্পনা নিয়ে কাজ করে যাচ্ছে।
            </p>
        </div>
    </section>

    <!-- Programs Grid -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($programs as $program)
                    <div class="relative h-full rounded-2xl overflow-hidden bg-white border hover:border-primary/50 shadow-lg shadow-gray-200/40 transition-all duration-500 hover:-translate-y-2 p-7 group">
                        <div class="w-14 h-14 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform {{ $program['icon_bg'] }}">
                            {!! $program['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 font-bangla">{{ $program['title'] }}</h3>
                        <p class="text-gray-500 text-sm font-bangla leading-relaxed mb-5">{{ $program['description'] }}</p>
                        <a href="{{ $program['link'] }}" class="inline-flex items-center gap-2 text-primary font-semibold text-sm font-bangla hover:gap-3 transition-all duration-300">
                            বিস্তারিত দেখুন
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7 7 7-7 7"/></svg>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Programs CTA -->
    <section class="py-16 bg-gradient-to-br from-emerald-700 via-green-700 to-emerald-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 24px 24px;"></div>
        </div>
        <div class="relative container mx-auto px-4 sm:px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl md:text-4xl font-bold mb-4 font-bangla leading-tight">মানবতার সেবায় আপনিও আমাদের অংশীদার হোন</h2>
                <p class="text-white/80 max-w-2xl mx-auto mb-8 font-bangla">আপনার ছোট একটি অবদান বদলে দিতে পারে একটি অবহেলিত মানুষের ভবিষ্যৎ। আজই আপনার পছন্দের প্রজেক্টে ডোনেট করুন।</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('donation.create') }}" class="inline-flex items-center justify-center bg-white text-green-700 px-8 py-4 text-lg font-semibold rounded-2xl shadow-lg hover:bg-emerald-50 hover:shadow-xl transition-all duration-300 font-bangla">
                        অনদান দিন
                    </a>
                    <a href="{{ route('volunteer.create') }}" class="inline-flex items-center justify-center border-2 border-white/50 text-white px-8 py-4 text-lg font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300 font-bangla">
                        ভলান্টিয়ার হিসেবে যুক্ত হোন
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
@endsection