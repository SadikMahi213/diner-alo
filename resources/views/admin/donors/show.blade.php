@extends('layouts.admin')

@section('title', 'Donor Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Donor: {{ $donor->name }}</h1>
        <a href="{{ route('admin.donors') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Back to Donors</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Donor Profile</h2>
                <div class="space-y-3 text-sm">
                    <div><span class="text-gray-500">Name:</span> <span class="font-medium text-gray-900">{{ $donor->name }}</span></div>
                    <div><span class="text-gray-500">Email:</span> {{ $donor->email }}</div>
                    <div><span class="text-gray-500">Mobile:</span> {{ $donor->mobile_number }}</div>
                    <div><span class="text-gray-500">Joined:</span> {{ $donor->created_at->format('M d, Y') }}</div>
                    <div><span class="text-gray-500">User:</span> {{ $donor->user?->name ?? 'Guest' }}</div>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4 text-center">
                    <div class="bg-emerald-50 rounded-lg p-3">
                        <p class="text-2xl font-bold text-emerald-600">{{ $donor->donations->count() }}</p>
                        <p class="text-xs text-gray-500">Total Donations</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-3">
                        <p class="text-2xl font-bold text-green-600">৳{{ number_format($totalSuccessful, 0) }}</p>
                        <p class="text-xs text-gray-500">Successful</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Donation History</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Transaction ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Fund</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Receipt</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($donor->donations as $donation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 font-mono text-xs">{{ $donation->transaction_id }}</td>
                                    <td class="px-4 py-2 text-sm">৳{{ number_format($donation->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $donation->fund?->name_en ?? '—' }}</td>
                                    <td class="px-4 py-2"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full border {{ $donation->status=='successful' ? 'bg-green-100 text-green-800 border-green-200' : 'bg-yellow-100 text-yellow-800 border-yellow-200' }}">{{ strtoupper($donation->status) }}</span></td>
                                    <td class="px-4 py-2 text-xs">{{ $donation->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 text-sm"><a href="{{ route('donation.receipt', $donation) }}" class="text-emerald-600 hover:text-emerald-800">Receipt</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">No donations yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
