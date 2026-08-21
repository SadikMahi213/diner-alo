@extends('layouts.front')
@section('title', 'পেমেন্ট ব্যর্থ')
@section('content')

<div class="min-h-[70vh] bg-gradient-to-br from-red-50 to-orange-50 py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-orange-500 px-6 py-8 text-center text-white">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <p class="inline-flex px-3 py-1 bg-white/15 rounded-full text-xs tracking-widest uppercase mb-3">ব্যর্থ</p>
                    <h1 class="text-2xl font-bold font-bangla">পেমেন্ট ব্যর্থ হয়েছে</h1>
                    <p class="text-white/80 text-sm mt-2 font-bangla">আপনার পেমেন্ট প্রক্রিয়া সম্পন্ন করা যায়নি</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">৳{{ number_format($donation->amount, 0) }}</p>
                        <p class="text-xs text-gray-400">লেনদেন: <span class="font-mono">{{ $donation->transaction_id }}</span></p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-bangla">ফান্ড</span>
                            <span class="font-medium font-bangla">{{ $donation->fund?->name_bn ?? 'সাধারণ দান' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-bangla">স্ট্যাটাস</span>
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Failed</span>
                        </div>
                        @if($donation->transaction?->failure_reason)
                        <div class="pt-2 border-t">
                            <p class="text-xs text-gray-500 font-bangla">কারণ:</p>
                            <p class="text-sm text-red-700">{{ $donation->transaction->failure_reason }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                        <p class="text-sm text-amber-800 font-bangla">কোনো টাকা কাটা হয়নি। আপনি নিরাপদে আবার চেষ্টা করতে পারেন।</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('donation.portal', $donation->id) }}" class="py-3 bg-emerald-600 text-white rounded-xl text-center font-medium hover:bg-emerald-700 font-bangla text-sm">আবার চেষ্টা করুন</a>
                        <a href="{{ route('donation.create') }}" class="py-3 border border-gray-300 rounded-xl text-center font-medium hover:bg-gray-50 font-bangla text-sm">নতুন দান</a>
                    </div>
                    <a href="{{ route('home') }}" class="block w-full py-3 bg-gray-900 text-white rounded-xl text-center font-bangla">হোমে ফিরুন</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
