@extends('layouts.front')
@section('title', 'কার্যক্রমসমূহ')
@section('styles')
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
@endsection
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
            <div class="inline-flex items-center gap-3 text-sm font-bold text-primary bg-white border border-emerald-200 px-4 py-2 rounded-full mb-5 shadow-sm">
                <span class="text-lg">{{ $activeProjectsCount }}</span>
                <span class="font-bangla">টি সক্রিয় কার্যক্রম</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-5 font-bangla leading-tight">
                আমাদের <span class="text-primary">কার্যক্রমসমূহ</span>
            </h1>
            <p class="text-gray-500 text-base md:text-lg max-w-2xl mx-auto font-bangla leading-relaxed">
                মানুষের সার্বিক কল্যাণ ও সামাজিক উন্নয়নে আন-নুসরা ফাউন্ডেশনের নানা রকম কার্যক্রম চলমান রয়েছে। প্রতিটি কার্যক্রম পরিচালিত হয় স্বচ্ছতা, জবাবদিহিতা ও সর্বোচ্চ মানের নিশ্চয়তা নিয়ে।
            </p>
        </div>
    </section>

    <!-- Activities Grid -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($featuredProjects as $project)
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                        <div class="h-48 bg-gradient-to-br from-emerald-50 to-gray-50 flex items-center justify-center overflow-hidden">
                            @if($project->cover_image && file_exists(public_path('storage/' . $project->cover_image)))
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs px-2 py-1 bg-emerald-50 text-emerald-700 rounded-full font-medium font-bangla">
                                    {{ $project->status === 'running' ? 'চলমান' : ($project->status === 'completed' ? 'সম্পন্ন' : 'আসন্ন') }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 font-bangla">{{ $project->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4 font-bangla line-clamp-2">{{ Str::limit($project->description, 80) }}</p>
                            <div class="mb-3">
                                <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-green-600 rounded-full" style="width: {{ min(100, $project->progress_percentage ?? 0) }}%"></div>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 font-bangla">{{ number_format($project->progress_percentage ?? 0, 0) }}% অগ্রগতি</p>
                            </div>
                            <a href="{{ route('donation.create') }}" class="text-primary font-medium hover:text-primary-dark text-sm font-bangla transition-colors">
                                দান করুন →
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                        <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <p class="text-gray-400 font-bangla text-lg">শীঘ্রই নতুন কার্যক্রম আসছে</p>
                        <p class="text-gray-400 font-bangla text-sm mt-2">এই মুহূর্তে কোনো সক্রিয় কার্যক্রম নেই</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Activities CTA -->
    <section class="py-14 bg-gradient-to-b from-white to-emerald-50/30">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 font-bangla leading-tight">মানবতার কল্যাণে আপনি-ও অংশ নিতে পারেন</h2>
                <p class="text-gray-500 mb-8 font-bangla">আপনার সময়, শ্রম বা অনুদান দিয়ে আমাদের চলমান কার্যক্রমে যুক্ত হোন।</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('donation.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-4 text-lg font-semibold rounded-2xl shadow-lg hover:from-emerald-600 hover:to-green-700 hover:shadow-xl transition-all duration-300 font-bangla">
                        দান করুন
                    </a>
                    <a href="{{ route('volunteer.create') }}" class="inline-flex items-center justify-center border-2 border-emerald-500 text-emerald-600 px-8 py-4 text-lg font-semibold rounded-2xl hover:bg-emerald-50 transition-all duration-300 font-bangla">
                        স্বেচ্ছাসেবক হোন
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
@endsection