@extends('layouts.admin')

@section('title', 'Members')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Members</h1>
        <a href="{{ route('admin.export.members') }}?{{ http_build_query(request()->query()) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Export CSV</a>
    </div>

    <form method="GET" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name / member ID / email" class="bg-white text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <select name="membership_type" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Types</option>
                @foreach(['general','lifetime','contributor','volunteer'] as $t)
                    <option value="{{ $t }}" {{ request('membership_type')==$t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
            <select name="status" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Status</option>
                @foreach(['pending','active','inactive','rejected','expired'] as $s)
                    <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ strtoupper($s) }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div class="flex gap-2 mt-3">
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-medium">Search</button>
            <a href="{{ route('admin.members') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Membership ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Join Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Expiry</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-mono text-xs text-gray-800">{{ $member->member_id }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $member->name }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $member->email ?? $member->user?->email }}<br>{{ $member->phone ?? $member->user?->mobile_number }}</td>
                            <td class="px-4 py-3"><span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border bg-gray-50 text-gray-700">{{ ucfirst($member->membership_type) }}</span></td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $member->join_date?->format('M d, Y') ?? $member->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $member->expiry_date ? $member->expiry_date->format('M d, Y') : '— Lifetime' }}</td>
                            <td class="px-4 py-3">
                                @php $badge = match($member->status ?? ($member->is_active ? 'active' : 'inactive')) { 'active'=>'bg-green-100 text-green-800 border-green-200', 'pending'=>'bg-yellow-100 text-yellow-800 border-yellow-200', 'rejected'=>'bg-red-100 text-red-800 border-red-200', default=>'bg-gray-100 text-gray-700 border-gray-200' }; @endphp
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">{{ strtoupper($member->status ?? ($member->is_active?'active':'inactive')) }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm"><a href="{{ route('admin.members.show', $member) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-12 text-center text-sm text-gray-500">No members found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4 border-t bg-gray-50">{{ $members->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
