@extends('layouts.front')

@section('title', 'Volunteer Application Submitted')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center border">
            <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Thank You!</h1>
            <p class="text-gray-600 mb-6">Your volunteer application has been submitted successfully. Our team will review your application and contact you soon.</p>
            
            <div class="bg-blue-50 rounded-xl p-6 text-left mb-6">
                <h2 class="font-bold text-gray-800 mb-3">What happens next?</h2>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2"><span class="text-blue-600">•</span> Our team will review your application within 3-5 business days</li>
                    <li class="flex gap-2"><span class="text-blue-600">•</span> You will receive an email notification once approved</li>
                    <li class="flex gap-2"><span class="text-blue-600">•</span> Approved volunteers will be assigned to projects based on skills and availability</li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium">Back to Home</a>
                <a href="{{ route('volunteer.create') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-medium">New Application</a>
            </div>
        </div>
    </div>
</div>
@endsection
