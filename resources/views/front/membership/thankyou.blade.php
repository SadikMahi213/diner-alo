@extends('layouts.front')

@section('title', 'Membership Application Submitted')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center border">
            <div class="w-20 h-20 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Application Submitted!</h1>
            <p class="text-gray-600 mb-6">Thank you, <span class="font-semibold text-gray-900">{{ $member->name }}</span>! Your membership application has been received and is pending approval.</p>
            
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-6">
                <h2 class="font-bold text-gray-800 mb-4">Application Details</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Membership ID:</span>
                        <span class="font-mono font-bold text-emerald-700">{{ $member->member_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Name:</span>
                        <span class="font-medium text-gray-900">{{ $member->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email:</span>
                        <span class="text-gray-900">{{ $member->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Phone:</span>
                        <span class="text-gray-900">{{ $member->phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Membership Type:</span>
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">{{ ucfirst($member->membership_type) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status:</span>
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">{{ strtoupper($member->status ?? 'pending') }}</span>
                    </div>
                </div>
            </div>

            <p class="text-sm text-gray-500 mb-6">You will be notified via email once your application is reviewed. This usually takes 3-5 business days.</p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium">Back to Home</a>
                <a href="{{ route('membership.create') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-xl font-medium">New Application</a>
            </div>
        </div>
    </div>
</div>
@endsection
