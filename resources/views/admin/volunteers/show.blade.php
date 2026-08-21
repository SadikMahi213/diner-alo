@extends('layouts.admin')

@section('title', 'Volunteer Details')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Volunteer: {{ $volunteer->name }}</h1>
        <a href="{{ route('admin.volunteers') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Back to Volunteers</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div><span class="text-gray-500">Name:</span> <span class="font-medium text-gray-900">{{ $volunteer->name }}</span></div>
            <div><span class="text-gray-500">Phone:</span> {{ $volunteer->phone }}</div>
            <div><span class="text-gray-500">Email:</span> {{ $volunteer->email }}</div>
            <div><span class="text-gray-500">District:</span> {{ $volunteer->district ?? '—' }}</div>
            <div><span class="text-gray-500">Profession:</span> {{ $volunteer->profession ?? '—' }}</div>
            <div><span class="text-gray-500">Address:</span> {{ $volunteer->address ?? '—' }}</div>
            <div><span class="text-gray-500">Skills:</span> {{ $volunteer->skills ?? '—' }}</div>
            <div><span class="text-gray-500">Availability:</span> {{ $volunteer->availability ?? '—' }}</div>
            <div><span class="text-gray-500">Preferred Activity:</span> {{ $volunteer->preferred_activity ?? '—' }}</div>
            <div><span class="text-gray-500">Experience:</span> {{ $volunteer->experience ?? '—' }}</div>
            <div><span class="text-gray-500">Status:</span> 
                @php $badge = match($volunteer->status){ 'approved'=>'bg-green-100 text-green-800 border-green-200', 'pending'=>'bg-yellow-100 text-yellow-800 border-yellow-200', 'rejected'=>'bg-red-100 text-red-800 border-red-200', default=>'bg-gray-100 text-gray-700 border-gray-200' }; @endphp
                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">{{ strtoupper($volunteer->status) }}</span>
            </div>
            <div><span class="text-gray-500">Applied:</span> {{ $volunteer->created_at->format('M d, Y H:i') }}</div>
            @if($volunteer->motivation)
                <div class="md:col-span-2"><span class="text-gray-500">Motivation:</span> {{ $volunteer->motivation }}</div>
            @endif
            @if($volunteer->nid)
                <div><span class="text-gray-500">NID:</span> {{ $volunteer->nid }}</div>
            @endif
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            @if($volunteer->status === 'pending')
                <form method="POST" action="{{ route('admin.volunteers.approve', $volunteer) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm font-medium" onclick="return confirm('Approve this volunteer?')">Approve</button>
                </form>
                <form method="POST" action="{{ route('admin.volunteers.reject', $volunteer) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm" onclick="return confirm('Reject this volunteer?')">Reject</button>
                </form>
            @elseif($volunteer->status === 'approved')
                <form method="POST" action="{{ route('admin.volunteers.deactivate', $volunteer) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-lg text-sm" onclick="return confirm('Deactivate this volunteer?')">Deactivate</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.volunteers.approve', $volunteer) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm">Reactivate</button>
                </form>
            @endif
            <a href="{{ route('admin.volunteers') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm">Back to List</a>
        </div>
        @if(session('success'))
            <div class="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
    </div>
</div>
@endsection
