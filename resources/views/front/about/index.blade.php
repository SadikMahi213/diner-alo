@extends('layouts.front')
@section('title', 'সম্পর্কে')
@section('content')

    <!-- About Header -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-400 mb-4 bengali">
                    আমাদের সম্পর্কে
                </h2>
                <p class="text-gray-400 text-lg mb-8 bengali">
                    দিনের আলো মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে।
                </p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-emerald-600 mb-6 bengali">Our Mission</h3>
                    <p class="text-gray-600 text-lg mb-4 bengali">
                        দিনের আলো মানুষের মৌলিক অধিকার, শিক্ষা, খাদ্য, চিকিৎসা ও আত্মনির্ভরতার জন্য কাজ করে। আমরা registered non-profit organization যara underserved communities, women, এবং elderly people সাহায্য করার জন্য committed।
                    </p>
                    <ul class="space-y-3 text-gray-600 text-sm bengali">
                        <li>📚 শিক্ষা এবং বিতর্কণের সুযোগ প্রদান</li>
                        <li>🍚 জরুরি খাদ্য সহায়তা</li>
                        <li>🏥 ফ্রি চিকিৎসা পরামর্শ</li>
                        <li>👕 সয়য়ালী ভíst support</li>
                        <li>💼 কর্মসংস্থান সহায়তা</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gold-600 mb-6 bengali">Our Vision</h3>
                    <p class="text-gray-600 text-lg mb-4 bengali">
                        একটি বিশ্ব যেখানে প্রতিটি মানুষ আত্মনির্ভরত এবং সম್মানের সাথে জ Boundaries ন 자유享用। Where every person lives with dignity and freedom beyond boundaries.
                    </p>
                    <p class="text-gray-600 text-lg mb-6 bengali">
                        bangladeshে রংক্ষয়মুক্ত ও সম affluent society rêve।
                        A prosperous and affluent society free from poverty in Bangladesh.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- History -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold text-emerald-600 mb-6 bengali>Our History</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-white rounded-xl border-l-4 border-emerald-500 hover-transition">
                        <h4 class="font-bold text-emerald-600 mb-2">2024 - Foundation</h4>
                        <p class="text-gray-500 text-sm">দিনের আলো registered as a non-profit organization in Bangladesh with the vision to serve humanity.</p>
                    </div>
                    <div class="p-4 bg-white rounded-xl border-l-4 border-gold-500 hover-transition">
                        <h4 class="font-bold text-gold-600 mb-2">2025 - Launch</h4>
                        <p class="text-gray-500 text-sm">Official launch of activities with first winter clothing distribution and medical camp.</p>
                    </div>
                    <div class="p-4 bg-white rounded-xl border-l-4 border-emerald-500 hover-transition">
                        <h4 class="font-bold text-emerald-600 mb-2">2026 - Expansion</h4>
                        <p class="text-gray-500 text-sm">Expanding operations to 25+ districts across Bangladesh with 10,000+ beneficiaries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold text-emerald-600 mb-6 bengali>Our Team</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Team Member 1 -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10v9m-5-3v9m5-3H9m20-3a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458l1.446 6.338A2 2 0 018.94 12.058L.44 4.338a2 2 0 013.403-1.376l8.933 4.077L27.542l-1.446-6.338a2 2 0 010-3.057z"/></svg>
                        </div>
                        <h4 class="font-medium text-emerald-600 mb-2">Dr. Mohammad Rahman</h4>
                        <p class="text-gray-500 text-sm">Founder & Chairman</p>
                    </div>
                    
                    <!-- Team Member 2 -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="w-16 h-16 rounded-full bg-gold-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2v6m-4-2v-6l-4-2v-6m4 2v6m-4-2v-6L12 3v6l-4 2v6M5 11h14m0 0v3a4 4 0 004 4h3a4 4 0 014 4v3m-8-3v12a2 2 0 002 2h2a2 2 0 002-2v-5m-12-2v5"></path></svg>
                        </div>
                        <h4 class="font-medium text-gold-600 mb-2">Sarah Akhter</h4>
                        <p class="text-gray-500 text-sm">Program Director</p>
                    </div>
                    
                    <!-- Team Member 3 -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover-transition">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2v-6m2 2l7-2 7 2M5 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h4 class="font-medium text-emerald-600 mb-2">Mohammad Islam</h4>
                        <p class="text-gray-500 text-sm">Finance Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
