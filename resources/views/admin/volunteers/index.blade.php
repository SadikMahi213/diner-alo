@extends('layouts.admin')

@section('title', 'Volunteers')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Volunteers</h1>
    <p class="text-sm text-gray-600 mb-6">All volunteer applications and assignments</p>

    <form method="GET" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name / phone / email / district" class="bg-white text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <select name="status" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Status</option>
                @foreach(['pending','approved','rejected','inactive'] as $s)
                    <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ strtoupper($s) }}</option>
                @endforeach
            </select>
            <select name="preferred_activity" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Activities</option>
                @foreach(['education','medical','food','relief','events','administrative','other'] as $a)
                    <option value="{{ $a }}" {{ request('preferred_activity')==$a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
                @endforeach
            </select>
            <select name="availability" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">Any Availability</option>
                @foreach(['weekends','weekdays','flexible','full_time'] as $av)
                    <option value="{{ $av }}" {{ request('availability')==$av ? 'selected' : '' }}>{{ ucfirst($av) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-medium">Search</button>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.volunteers') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Volunteer</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">District</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Skills</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Preferred</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Availability</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($volunteers as $volunteer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $volunteer->name }}</div>
                                <div class="text-xs text-gray-500">{{ $volunteer->email }} • {{ $volunteer->phone }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $volunteer->district ?? '—' }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ Str::limit($volunteer->skills ?? '—', 40) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $volunteer->preferred_activity ?? '—' }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $volunteer->availability ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @php $badge = match($volunteer->status) { 'approved'=>'bg-green-100 text-green-800 border-green-200', 'pending'=>'bg-yellow-100 text-yellow-800 border-yellow-200', 'rejected'=>'bg-red-100 text-red-800 border-red-200', default=>'bg-gray-100 text-gray-700 border-gray-200' }; @endphp
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">{{ strtoupper($volunteer->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $volunteer->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm"><a href="{{ route('admin.volunteers.show', $volunteer) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-12 text-center text-sm text-gray-500">No volunteers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4 border-t bg-gray-50">{{ $volunteers->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
