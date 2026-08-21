@extends('layouts.front')
@section('title', 'পেমেন্ট সফল')
@section('content')

<div class="min-h-[70vh] bg-gradient-to-br from-emerald-50 to-teal-50 py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-8 text-center text-white">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="inline-flex items-center gap-2 px-3 py-1 bg-white/15 rounded-full text-xs tracking-widest uppercase font-medium mb-3">সফল</p>
                    <h1 class="text-2xl md:text-3xl font-bold font-bangla">পেমেন্ট সফল হয়েছে</h1>
                    <p class="text-white/80 text-sm mt-2 font-bangla">আপনার উদার অনুদানের জন্য আন্তরিক ধন্যবাদ</p>
                </div>

                <div class="p-6 space-y-5">
                    <!-- Amount -->
                    <div class="text-center py-2">
                        <p class="text-xs text-gray-500 tracking-widest uppercase">পরিমাণ</p>
                        <p class="text-3xl font-bold text-gray-900">৳{{ number_format($donation->amount, 0) }}</p>
                        <p class="text-xs text-gray-400">BDT • {{ $donation->currency ?? 'BDT' }}</p>
                    </div>

                    <!-- Details Card -->
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">লেনদেন আইডি</span>
                            <span class="font-mono font-bold text-gray-900 text-xs">{{ $donation->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">ফান্ড</span>
                            <span class="font-medium text-gray-900 font-bangla text-sm">{{ $donation->fund?->name_bn ?? $donation->fund?->name_en ?? 'সাধারণ দান' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">পদ্ধতি</span>
                            <span class="text-gray-900 text-sm uppercase">{{ $donation->payment_method ?? $donation->transaction?->gateway_name ?? 'SSLCommerz' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">তারিখ</span>
                            <span class="text-gray-900 text-sm">{{ $donation->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">দাতা</span>
                            <span class="text-gray-900 text-sm font-bangla">{{ $donation->donor->name ?? 'অতিথি' }} @if($donation->is_anonymous) <span class="text-xs text-gray-400">(গোপন)</span> @endif</span>
                        </div>
                        @if($donation->transaction?->gateway_transaction_id)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">গেটওয়ে রেফ</span>
                            <span class="font-mono text-xs text-gray-700">{{ $donation->transaction->gateway_transaction_id }}</span>
                        </div>
                        @endif
                    </div>

                    @if($donation->donor)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3">
                        <p class="text-xs text-blue-800 font-bangla">রসিদটি <span class="font-medium">{{ $donation->donor->email }}</span> -এ পাঠানো হয়েছে। @if(!str_contains($donation->donor->email, '@placeholder.local')) @else <span class="text-blue-600">(ফোন: {{ $donation->donor->mobile_number }})</span> @endif</p>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('donation.receipt', $donation->id) }}" class="py-3 bg-emerald-600 text-white rounded-xl text-center font-medium hover:bg-emerald-700 transition-colors font-bangla text-sm">রসিদ দেখুন</a>
                        <a href="{{ route('donation.download-receipt', $donation->id) }}" class="py-3 border border-gray-300 rounded-xl text-center font-medium hover:bg-gray-50 font-bangla text-sm">ডাউনলোড</a>
                    </div>
                    <a href="{{ route('home') }}" class="block w-full py-3 bg-gray-900 text-white rounded-xl text-center font-medium hover:bg-black transition-colors font-bangla">হোমে ফিরুন</a>

                    <p class="text-center text-xs text-gray-400 font-bangla">প্রয়োজনে যোগাযোগ: info@dineralo.org • 01712345678</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
