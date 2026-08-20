@extends('layouts.front')
@section('title', 'দানের সফল')

@section('content')

    <!-- Success Banner -->
    <section class="py-16 bg-emerald-600">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13h14a3 3 0 003-3V8a3 3 0 00-3-3H5a3 3 0 00-3 3v1m4 6l-3-3m3 3l3 3m2-3h-1M7 23l-3-3m3 3l-3 3m2-3h-1M7 23l-3-3m3 3l-3 3m2-3h-1"/></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-200 mb-4 bengali">
                    donation successful
                </h2>
                <p class="text-emerald-100 text-lg mb-8 bengali">
                    আপনার দান সফলভাবে জমা হয়েছে।Receipt download করতে ডাউনলোড বাটনে ক্লিক করুন।
                </p>

                <div class="grid grid-cols-2 gap-4 mx-auto">
                    <a href="{{ route('donation.receipt', ['id' => $donation->id]) }}"
                       class="bg-white text-emerald-600 px-6 py-3 rounded-full font-medium hover:bg-emerald-100 transition-colors text-lg">
                       রসিদ ডাউনলোড করুন
                    </a>
                    <a href="{{ route('donation.receipt', ['id' => $donation->id]) }}"
                       class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:text-emerald-100 transition-colors text-lg">
                       প্রিন্ট করুন
                    </a>
                </div>

                <a href="{{ route('home') }}"
                    class="mt-6 bg-gray-900 text-white px-6 py-3 rounded-full font-medium hover:bg-gray-800 transition-colors text-lg">
                    হোমপেজে ফিরুন
                </a>
            </div>
        </div>
    </section>

@endsection
