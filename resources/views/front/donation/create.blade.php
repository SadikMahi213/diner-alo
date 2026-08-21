@extends('layouts.front')
@section('title', 'দান করুন')
@section('content')

    <!-- Hero / Header matching reference DonationCard context -->
    <section class="relative overflow-hidden bg-gradient-to-b from-emerald-50 via-white to-white py-10 md:py-14">
        <div class="absolute inset-0 opacity-30 pointer-events-none">
            <div class="absolute top-10 left-10 w-96 h-96 bg-gradient-to-br from-emerald-100/40 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-10 w-80 h-80 bg-gradient-to-tr from-amber-100/30 to-transparent rounded-full blur-3xl"></div>
        </div>
        <div class="relative container mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 border border-emerald-200 text-emerald-700 mb-4">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                নিরাপদ অনুদান
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 font-bangla">দান করুন</h1>
            <p class="text-gray-500 max-w-2xl mx-auto font-bangla">আপনার মূল্যবান অনুদানের মাধ্যমে অসহায় মানুষের জীবন পরিবর্তন করুন। প্রতিটি টাকা স্বচ্ছতার সাথে ব্যয় করা হয়।</p>
        </div>
    </section>

    <!-- Donation Form Card - Reference Style -->
    <section class="py-8 md:py-12 bg-[#f8f9fa]">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/15 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>
                            <div>
                                <h2 class="font-bold text-lg font-bangla">দ্রুত অনুদান করুন</h2>
                                <p class="text-white/80 text-xs font-bangla">সর্বনিম্ন ১০০ টাকা • নিরাপদ পেমেন্ট</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('donation.sslcommerz.initiate') }}" method="POST" id="donationForm" class="p-6 space-y-5">
                        @csrf
                        @if($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm font-bangla">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm font-bangla">{{ session('error') }}</div>
                        @endif

                        <!-- Fund Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 font-bangla">ফান্ড সিলেক্ট করুন <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="donation_fund_id" id="fundSelect" required class="w-full px-4 py-3.5 pr-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white appearance-none font-bangla text-sm">
                                    <option value="">ফান্ড সিলেক্ট করুন</option>
                                    @foreach($funds as $fund)
                                        <option value="{{ $fund->id }}" {{ old('donation_fund_id') == $fund->id ? 'selected' : '' }}>{{ $fund->name_bn }} / {{ $fund->name_en }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('donation_fund_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Contact (Phone / Email) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 font-bangla">ফোন নম্বর / ইমেইল <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.986a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="text" name="contact" id="contactInput" value="{{ old('contact', old('email') ?: old('mobile_number')) }}" required placeholder="ফোন নম্বর / ইমেইল লিখুন" class="w-full pl-11 pr-4 py-3.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-bangla text-sm" />
                            </div>
                            <p class="text-xs text-gray-400 mt-1 font-bangla">যেমন: 01712345678 অথবা example@mail.com</p>
                            @error('contact') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Amount with quick selects -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 font-bangla">পরিমাণ (টাকা) <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                @foreach([500,1000,2500,5000,10000,20000] as $preset)
                                    <button type="button" data-amount="{{ $preset }}" class="amount-preset px-3 py-2.5 border border-gray-200 rounded-xl text-sm font-medium hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">৳{{ number_format($preset) }}</button>
                                @endforeach
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-gray-500 font-bold">৳</span>
                                <input type="number" name="amount" id="amountInput" value="{{ old('amount') }}" required min="100" max="1000000" step="1" placeholder="পরিমাণ লিখুন" class="w-full pl-8 pr-20 py-3.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-right font-medium" />
                                <span class="absolute inset-y-0 right-3 flex items-center text-xs text-gray-400 font-bangla">BDT</span>
                            </div>
                            @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            <p class="text-xs text-amber-600 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 mt-2 font-bangla">সর্বনিম্ন অনুদান ১০০ টাকা।</p>
                        </div>

                        <!-- Project (optional, collapsible) -->
                        @if($projects->count())
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 font-bangla">প্রজেক্ট (ঐচ্ছিক)</label>
                            <select name="project_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-bangla text-sm">
                                <option value="">প্রজেক্ট নির্বাচন করুন</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 font-bangla">বার্তা (ঐচ্ছিক)</label>
                            <textarea name="message" rows="2" placeholder="আপনার বার্তা লিখুন..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 resize-none font-bangla text-sm">{{ old('message') }}</textarea>
                        </div>

                        <!-- Hidden fields for backward compat -->
                        <input type="hidden" name="payment_method" value="sslcommerz">
                        <input type="hidden" name="is_anonymous" value="0">

                        <!-- Terms -->
                        <label class="flex gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-emerald-50/50 transition-colors">
                            <input type="checkbox" name="terms" value="1" required id="termsCheck" class="mt-1 w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs text-gray-600 leading-relaxed font-bangla">
                                আমি <a href="#" class="text-emerald-600 hover:underline">শর্তাবলী</a>, <a href="#" class="text-emerald-600 hover:underline">গোপনীয়তা নীতি</a> এবং <a href="#" class="text-emerald-600 hover:underline">ফেরত নীতি</a>-তে সম্মতি দিচ্ছি।
                            </span>
                        </label>
                        @error('terms') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                        <!-- Donate Button -->
                        <button type="submit" id="donateBtn" class="w-full py-4 px-8 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2 font-bangla text-base">
                            <span id="donateText">দান করুন</span>
                            <svg id="donateSpinner" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <svg id="donateArrow" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>

                        <!-- Secure badge -->
                        <div class="flex items-center justify-center gap-4 text-xs text-gray-400 pt-2">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg> নিরাপদ পেমেন্ট</span>
                            <span>•</span>
                            <span>SSLCommerz দ্বারা সুরক্ষিত</span>
                            <span>•</span>
                            <span>১০০% স্বচ্ছ</span>
                        </div>
                    </form>
                </div>

                <!-- Payment partners -->
                <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs text-gray-400">
                    <span class="font-bangla">পেমেন্ট পার্টনার:</span>
                    <span class="px-3 py-1 bg-white border rounded-lg">bKash</span>
                    <span class="px-3 py-1 bg-white border rounded-lg">Nagad</span>
                    <span class="px-3 py-1 bg-white border rounded-lg">Rocket</span>
                    <span class="px-3 py-1 bg-white border rounded-lg">Visa/Mastercard</span>
                    <span class="px-3 py-1 bg-white border rounded-lg">Bank</span>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amountInput');
    const presets = document.querySelectorAll('.amount-preset');
    const form = document.getElementById('donationForm');
    const btn = document.getElementById('donateBtn');
    const spinner = document.getElementById('donateSpinner');
    const text = document.getElementById('donateText');
    const arrow = document.getElementById('donateArrow');

    presets.forEach(b => {
        b.addEventListener('click', () => {
            presets.forEach(x => x.classList.remove('bg-emerald-600','text-white','border-emerald-600'));
            b.classList.add('bg-emerald-600','text-white','border-emerald-600');
            amountInput.value = b.dataset.amount;
            amountInput.focus();
        });
    });

    form.addEventListener('submit', function() {
        btn.disabled = true;
        spinner.classList.remove('hidden');
        arrow.classList.add('hidden');
        text.textContent = 'প্রক্রিয়াকরণ...';
    });
});
</script>
@endsection
