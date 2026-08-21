@extends('layouts.front')
@section('title', 'রসিদ')
@section('content')

<div class="min-h-[70vh] bg-gray-50 py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" id="receipt">
            <div class="bg-gray-900 text-white px-6 py-6 flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-bold font-bangla">দিনের আলো</h2>
                    <p class="text-xs text-gray-400">Donation Receipt • অনুদান রসিদ</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">লেনদেন আইডি</p>
                    <p class="font-mono text-sm font-bold">{{ $donation->transaction_id }}</p>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500 text-xs">দাতার নাম</p>
                        <p class="font-medium font-bangla">{{ $donation->donor->name ?? 'Anonymous' }} @if($donation->is_anonymous) <span class="text-xs text-gray-400">(গোপন)</span> @endif</p>
                        <p class="text-xs text-gray-500">{{ $donation->donor->email ?? '' }}</p>
                        <p class="text-xs text-gray-500">{{ $donation->donor->mobile_number ?? '' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-xs">তারিখ ও সময়</p>
                        <p class="font-medium">{{ $donation->created_at->format('d M Y, h:i A') }}</p>
                        <p class="text-xs text-gray-500">স্ট্যাটাস: <span class="capitalize font-medium @if($donation->status==='successful') text-emerald-600 @else text-amber-600 @endif">{{ $donation->status }}</span></p>
                    </div>
                </div>

                <div class="border-t border-b py-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500 font-bangla">ফান্ড / উদ্দেশ্য</span>
                        <span class="font-medium font-bangla">{{ $donation->fund?->name_bn ?? $donation->fund?->name_en ?? 'সাধারণ দান' }}</span>
                    </div>
                    @if($donation->project)
                    <div class="flex justify-between">
                        <span class="text-gray-500 font-bangla">প্রজেক্ট</span>
                        <span class="font-medium">{{ $donation->project->title }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-500 font-bangla">পেমেন্ট পদ্ধতি</span>
                        <span class="uppercase text-sm">{{ $donation->payment_method ?? $donation->transaction?->gateway_name ?? '-' }}</span>
                    </div>
                    @if($donation->transaction?->gateway_transaction_id)
                    <div class="flex justify-between">
                        <span class="text-gray-500 font-bangla">গেটওয়ে রেফ</span>
                        <span class="font-mono text-xs">{{ $donation->transaction->gateway_transaction_id }}</span>
                    </div>
                    @endif
                </div>

                <div class="bg-emerald-50 rounded-xl p-4 flex justify-between items-center">
                    <span class="font-medium font-bangla">মোট পরিমাণ</span>
                    <span class="text-2xl font-bold text-emerald-700">৳{{ number_format($donation->amount, 2) }}</span>
                </div>

                @if($donation->message)
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-500 font-bangla">বার্তা</p>
                    <p class="text-sm font-bangla">{{ $donation->message }}</p>
                </div>
                @endif

                <div class="flex gap-3 print:hidden">
                    <button onclick="window.print()" class="flex-1 py-3 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 font-bangla">প্রিন্ট করুন</button>
                    <a href="{{ route('donation.download-receipt', $donation->id) }}" class="flex-1 py-3 border border-gray-300 rounded-xl text-center font-medium hover:bg-gray-50 font-bangla">ডাউনলোড</a>
                </div>

                <div class="text-center text-xs text-gray-400 border-t pt-4">
                    <p>দিনের আলো • মানবতার সেবায় • info@dineralo.org</p>
                    <p class="mt-1">এটি একটি কম্পিউটার জেনারেটেড রসিদ।</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    header, footer, .fab-button { display: none !important; }
    body { background: white !important; }
}
</style>

@endsection
