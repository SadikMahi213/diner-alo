@extends('layouts.front')
@section('title', 'মানুষের পাশে, আলোর পথে')
@section('content')
    
    <!-- Hero Section -->
    <section id="hero" class="relative min-h-[600px] bg-[#f8f9fa] overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-b from-[#f8f9fa] to-gray-50"></div>
        </div>
        <div class="relative inset-0 flex items-center justify-center text-center px-4 py-14 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto mt-24 sm:mt-0">
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 font-bangla">
                    দ্বীনের আলো
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
    <section class="py-16 bg-[#f8f9fa]">
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
                            <h3 class="text-2xl font-bold text-emerald-600 mb-3 font-bangla">{{ $fund->name_bn ?? $fund->name_en }}</h3>
                            <p class="text-gray-700 mb-4 font-bangla">{{ Str::limit($fund->description, 100) }}</p>
                            <div class="text-3xl font-bold text-emerald-600 mb-4 font-bangla">
                                ৳{{ number_format($fund->minimum_amount ?? 100, 0) }}+
                            </div>
                            <a href="{{ route('donation.create') }}" class="bg-emerald text-white px-6 py-3 rounded-full font-medium hover:bg-emerald-dark transition-colors inline-block font-bangla">
                                দান করুন
                            </a>
                        </div>
                    </div>
                    @empty
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
                            <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6m4-2v6l4-2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
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
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1v4h-1m0 0h1m-1-4h1v4h-1m1 8V7a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0h1m-1 0l-3 3m-3-3l3 3m0 0l3-3m-3 3l3-3"></path></svg>
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

    <!-- Donation CTA - Reference DonationCard Workflow -->
    <section id="donate" class="py-16 bg-gradient-to-br from-emerald-600 via-teal-600 to-emerald-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <div class="text-white">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4 font-bangla leading-tight">দান করুন এবং<br>জীবনের আলো বানান</h2>
                        <p class="text-white/80 mb-6 font-bangla">আপনার ছোট্ট সহায়তা কারোর জীবনে পরিবর্তন আনতে পারে। প্রতিটি দান স্বচ্ছতার সাথে ব্যয় করা হয়।</p>
                        <div class="flex flex-wrap gap-2 text-xs">
                            <span class="px-3 py-1 bg-white/15 rounded-full">১০০% স্বচ্ছ</span>
                            <span class="px-3 py-1 bg-white/15 rounded-full">SSL সুরক্ষিত</span>
                            <span class="px-3 py-1 bg-white/15 rounded-full">তাৎক্ষণিক রসিদ</span>
                        </div>
                    </div>

                    <!-- Inline Donation Card (reference: fund → contact → amount → donate) -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg></div>
                            <h3 class="font-bold text-gray-900 font-bangla">দ্রুত অনুদান</h3>
                            <span class="ml-auto text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-full">সর্বনিম্ন ১০০৳</span>
                        </div>

                        <form action="{{ route('donation.sslcommerz.initiate') }}" method="POST" id="homeDonationForm" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1 font-bangla">ফান্ড সিলেক্ট করুন *</label>
                                <select name="donation_fund_id" required class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm font-bangla bg-white">
                                    <option value="">ফান্ড সিলেক্ট করুন</option>
                                    @foreach($donationFunds as $fund)
                                        <option value="{{ $fund->id }}">{{ $fund->name_bn }} / {{ $fund->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1 font-bangla">ফোন নম্বর / ইমেইল *</label>
                                <input type="text" name="contact" required placeholder="ফোন নম্বর / ইমেইল লিখুন" class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bangla">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1 font-bangla">পরিমাণ (টাকা) *</label>
                                <div class="grid grid-cols-3 gap-2 mb-2">
                                    @foreach([500,1000,2500] as $a)
                                        <button type="button" onclick="document.querySelector('#homeDonationForm [name=amount]').value={{ $a }}" class="py-2 border rounded-lg text-sm hover:bg-emerald-50 hover:border-emerald-300">৳{{ $a }}</button>
                                    @endforeach
                                </div>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 font-bold">৳</span>
                                    <input type="number" name="amount" required min="100" placeholder="পরিমাণ লিখুন" class="w-full pl-7 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 text-right">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">BDT</span>
                                </div>
                            </div>

                            <label class="flex gap-2 text-xs text-gray-600 font-bangla">
                                <input type="checkbox" name="terms" value="1" required class="rounded text-emerald-600">
                                <span>আমি <a href="#" class="text-emerald-600 underline">শর্তাবলী</a>, <a href="#" class="text-emerald-600 underline">গোপনীয়তা</a> ও <a href="#" class="text-emerald-600 underline">ফেরত নীতি</a>-তে সম্মত।</span>
                            </label>

                            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-700 hover:to-teal-700 shadow-lg font-bangla">দান করুন</button>
                            <p class="text-center text-xs text-gray-400 font-bangla">bKash • Nagad • Rocket • Card • Bank → SSLCommerz</p>
                        </form>
                    </div>
                </div>
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
                                    <h3 class="text-xl font-bold text-gray-900 font-bangla">ঠিকানা</h3>
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
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 font-bangla">আমাদের বার্তা পাঠান</h3>
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
@endsection

@section('scripts')
<script>
    function setAmount(amount) {
        // Placeholder for donation amount setting
    }
</script>
@endsection
