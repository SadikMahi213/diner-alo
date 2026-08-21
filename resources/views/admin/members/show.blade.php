@extends('layouts.admin')

@section('title', 'Member Details')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Member: {{ $member->name }} ({{ $member->member_id }})</h1>
        <a href="{{ route('admin.members') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Back to Members</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div><span class="text-gray-500">Member ID:</span> <span class="font-mono font-medium text-gray-900">{{ $member->member_id }}</span></div>
            <div><span class="text-gray-500">Membership Type:</span> <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border bg-gray-50 text-gray-700">{{ ucfirst($member->membership_type) }}</span></div>
            <div><span class="text-gray-500">Name:</span> {{ $member->name }}</div>
            <div><span class="text-gray-500">Email:</span> {{ $member->email ?? $member->user?->email ?? '—' }}</div>
            <div><span class="text-gray-500">Phone:</span> {{ $member->phone ?? $member->user?->mobile_number ?? '—' }}</div>
            <div><span class="text-gray-500">District:</span> {{ $member->district ?? '—' }}</div>
            <div><span class="text-gray-500">Profession:</span> {{ $member->profession ?? '—' }}</div>
            <div><span class="text-gray-500">Join Date:</span> {{ $member->join_date?->format('M d, Y') ?? $member->created_at->format('M d, Y') }}</div>
            <div><span class="text-gray-500">Expiry:</span> {{ $member->expiry_date ? $member->expiry_date->format('M d, Y') : '— Lifetime' }}</div>
            <div><span class="text-gray-500">Status:</span> 
                @php $s = $member->status ?? ($member->is_active ? 'active' : 'inactive'); $badge = match($s){ 'active'=>'bg-green-100 text-green-800 border-green-200', 'pending'=>'bg-yellow-100 text-yellow-800 border-yellow-200', 'rejected'=>'bg-red-100 text-red-800 border-red-200', default=>'bg-gray-100 text-gray-700 border-gray-200' }; @endphp
                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">{{ strtoupper($s) }}</span>
            </div>
            @if($member->experience)
                <div class="md:col-span-2"><span class="text-gray-500">Experience:</span> {{ $member->experience }}</div>
            @endif
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            @if(($member->status ?? ($member->is_active ? 'active' : 'inactive')) === 'pending')
                <form method="POST" action="{{ route('admin.members.approve', $member) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm font-medium" onclick="return confirm('Approve this member?')">Approve & Activate</button>
                </form>
                <form method="POST" action="{{ route('admin.members.reject', $member) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm" onclick="return confirm('Reject this member?')">Reject</button>
                </form>
            @elseif(($member->status ?? ($member->is_active ? 'active' : 'inactive')) === 'active')
                <form method="POST" action="{{ route('admin.members.deactivate', $member) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-lg text-sm" onclick="return confirm('Deactivate this member?')">Deactivate</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.members.approve', $member) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm">Reactivate</button>
                </form>
            @endif
            <a href="{{ route('admin.members') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm">Back to List</a>
        </div>
        @if(session('success'))
            <div class="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
    </div>
</div>
@endsection
