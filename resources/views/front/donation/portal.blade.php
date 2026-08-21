@extends('layouts.front')
@section('title', 'পেমেন্ট পোর্টাল')
@section('content')

<div class="min-h-[70vh] bg-gradient-to-br from-gray-50 to-emerald-50/30 py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <!-- Merchant Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 mx-auto bg-emerald-600 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 20v2M2 12h2m16 0h2"/></svg>
                </div>
                <h2 class="font-bold text-gray-900 font-bangla">দিনের আলো</h2>
                <p class="text-xs text-gray-500 font-bangla">অনুদান পেমেন্ট পোর্টাল • SSLCommerz সুরক্ষিত</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <!-- Amount Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-6 text-white text-center">
                    <p class="text-white/70 text-xs tracking-widest uppercase font-medium">পরিশোধের পরিমাণ</p>
                    <p class="text-3xl md:text-4xl font-bold mt-1">৳{{ number_format($donation->amount, 0) }}</p>
                    <p class="text-white/60 text-xs mt-1">BDT • {{ $donation->currency ?? 'BDT' }}</p>
                    <div class="inline-flex items-center gap-2 mt-3 px-3 py-1 bg-white/15 rounded-full text-xs">
                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        <span class="font-bangla">{{ ucfirst($donation->status) }}</span>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <!-- Transaction Details -->
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">লেনদেন আইডি</span>
                            <span class="font-mono font-medium text-gray-900 text-xs">{{ $donation->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">ফান্ড / উদ্দেশ্য</span>
                            <span class="font-medium text-gray-900 font-bangla text-sm text-right">{{ $donation->fund?->name_bn ?? $donation->fund?->name_en ?? 'সাধারণ দান' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">দাতা</span>
                            <span class="font-medium text-gray-900 text-sm">{{ $donation->donor->name ?? 'অতিথি' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">তারিখ</span>
                            <span class="text-gray-900 text-sm">{{ $donation->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                        @if($donation->transaction)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bangla">গেটওয়ে</span>
                            <span class="text-gray-900 text-sm uppercase">{{ $donation->transaction->gateway_name ?? $donation->payment_method }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Payment Methods Preview -->
                    @if($donation->status === 'pending' || $donation->status === 'processing')
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-3 font-bangla tracking-wider uppercase">পেমেন্ট পদ্ধতি</p>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="border border-emerald-200 bg-emerald-50 rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-emerald-700">bKash</div>
                                <div class="text-[10px] text-gray-500">মোবাইল</div>
                            </div>
                            <div class="border border-gray-200 bg-white rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-gray-700">Nagad</div>
                                <div class="text-[10px] text-gray-500">মোবাইল</div>
                            </div>
                            <div class="border border-gray-200 bg-white rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-gray-700">Rocket</div>
                                <div class="text-[10px] text-gray-500">মোবাইল</div>
                            </div>
                            <div class="border border-gray-200 bg-white rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-gray-700">Visa</div>
                                <div class="text-[10px] text-gray-500">কার্ড</div>
                            </div>
                            <div class="border border-gray-200 bg-white rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-gray-700">Master</div>
                                <div class="text-[10px] text-gray-500">কার্ড</div>
                            </div>
                            <div class="border border-gray-200 bg-white rounded-xl p-3 text-center">
                                <div class="text-xs font-bold text-gray-700">Bank</div>
                                <div class="text-[10px] text-gray-500">ট্রান্সফার</div>
                            </div>
                        </div>
                        <p class="text-center text-xs text-gray-400 mt-2 font-bangla">SSLCommerz হোস্টেড পেজে সকল পদ্ধতি উপলব্ধ</p>
                    </div>
                    @endif

                    <!-- Status Messages -->
                    @if($donation->status === 'pending')
                        <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 flex gap-3">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-sm text-amber-800 font-bangla">পেমেন্ট যাচাই করা হচ্ছে। অনুগ্রহ করে অপেক্ষা করুন।</p>
                        </div>
                    @elseif($donation->status === 'processing')
                        <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <p class="text-sm text-blue-800 font-bangla">আপনার পেমেন্ট প্রক্রিয়াধীন। গেটওয়ে রেসপন্সের জন্য অপেক্ষা করছি।</p>
                        </div>
                    @elseif($donation->status === 'successful')
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 flex gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <p class="text-sm text-emerald-800 font-bangla">পেমেন্ট সফলভাবে সম্পন্ন হয়েছে।</p>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="space-y-3 pt-2">
                        @if(in_array($donation->status, ['pending','processing']) && $donation->payment_method === 'sslcommerz')
                            <form action="{{ route('donation.sslcommerz.initiate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="donation_fund_id" value="{{ $donation->donation_fund_id }}">
                                <input type="hidden" name="amount" value="{{ $donation->amount }}">
                                <input type="hidden" name="name" value="{{ $donation->donor->name }}">
                                <input type="hidden" name="email" value="{{ $donation->donor->email }}">
                                <input type="hidden" name="mobile_number" value="{{ $donation->donor->mobile_number }}">
                                <input type="hidden" name="terms" value="1">
                                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all shadow-lg flex items-center justify-center gap-2 font-bangla">
                                    নিরাপদ পেমেন্টে যান
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </button>
                            </form>
                            <p class="text-center text-xs text-gray-400 font-bangla">আপনাকে SSLCommerz নিরাপদ পেমেন্ট পেজে নিয়ে যাওয়া হবে</p>
                        @elseif($donation->status === 'successful')
                            <a href="{{ route('donation.receipt', $donation->id) }}" class="block w-full py-3.5 bg-emerald-600 text-white font-bold rounded-xl text-center hover:bg-emerald-700 transition-colors font-bangla">রসিদ দেখুন</a>
                            <a href="{{ route('donation.download-receipt', $donation->id) }}" class="block w-full py-3 border border-gray-300 rounded-xl text-center hover:bg-gray-50 font-bangla text-sm">রসিদ ডাউনলোড</a>
                        @endif

                        <div class="flex gap-2">
                            <a href="{{ route('donation.create') }}" class="flex-1 py-3 border border-gray-200 rounded-xl text-center text-sm hover:bg-gray-50 font-bangla">নতুন দান</a>
                            <a href="{{ route('home') }}" class="flex-1 py-3 border border-gray-200 rounded-xl text-center text-sm hover:bg-gray-50 font-bangla">হোমে ফিরুন</a>
                        </div>
                    </div>

                    <!-- Security Footer -->
                    <div class="flex items-center justify-center gap-2 text-xs text-gray-400 border-t pt-4">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>256-bit SSL • PCI DSS Compliant • 3D Secure</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
