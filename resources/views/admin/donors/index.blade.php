@extends('layouts.admin')

@section('title', 'Donors')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Donors</h1>
    <p class="text-sm text-gray-600 mb-6">All donors with aggregated donation statistics</p>

    @php
        $totalDonors = \App\Models\Donor::count();
        $totalAmount = \App\Models\Donation::where('status','successful')->sum('amount');
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total Donors</p>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalDonors) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total Successful Amount</p>
            <p class="text-2xl font-bold text-emerald-600">৳{{ number_format($totalAmount, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Search</p>
            <p class="text-sm text-gray-600">Use donor name, email or mobile</p>
        </div>
    </div>

    <form method="GET" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm mb-6 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Name / email / mobile" class="bg-white text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-3 py-2 text-sm flex-1 min-w-[220px] focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        <button type="submit" class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-medium">Search</button>
        <a href="{{ route('admin.donors') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium">Reset</a>
    </form>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Donor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Donations</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Successful Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Last Donation</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Joined</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($donors as $donor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $donor->name }}</div>
                                <div class="text-xs text-gray-500">ID: {{ $donor->id }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-900">{{ $donor->email }}</div>
                                <div class="text-xs text-gray-500">{{ $donor->mobile_number }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $donor->donations_count ?? $donor->donations->count() }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-emerald-700">৳{{ number_format($donor->successful_sum ?? $donor->donations->where('status','successful')->sum('amount'), 2) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ optional($donor->donations->sortByDesc('created_at')->first())->created_at?->format('M d, Y') ?? '—' }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $donor->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm"><a href="{{ route('admin.donors.show', $donor) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">No donors found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4 border-t bg-gray-50">{{ $donors->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
