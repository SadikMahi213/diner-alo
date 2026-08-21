@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class='container mx-auto px-4 py-8 text-gray-900'>
    <h1 class='text-3xl font-bold text-gray-900 mb-6'>Transactions</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-4 bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search TX ID..." class="bg-white text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        <select name="status" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">All Status</option>
            @foreach(['pending','processing','successful','failed','cancelled','refunded'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <select name="gateway" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">All Gateways</option>
            <option value="sslcommerz" {{ request('gateway')=='sslcommerz' ? 'selected' : '' }}>SSLCommerz</option>
            <option value="manual" {{ request('gateway')=='manual' ? 'selected' : '' }}>Manual</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        <button type="submit" class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-medium">Filter</button>
        <a href="{{ route('admin.transactions.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm">Reset</a>
    </form>

    <div class='bg-white shadow-md rounded-lg overflow-hidden border border-gray-200'>
        <div class="overflow-x-auto">
            <table class='min-w-full divide-y divide-gray-200'>
                <thead class='bg-gray-50'>
                    <tr>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Transaction ID</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>User/Donor</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Amount</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Gateway</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Status</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Date</th>
                        <th class='px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider'>Action</th>
                    </tr>
                </thead>
                <tbody class='bg-white divide-y divide-gray-200'>
                    @forelse($transactions as $tx)
                        <tr class="hover:bg-gray-50">
                            <td class='px-6 py-4 font-mono text-xs text-gray-900'>{{ $tx->transaction_id }}</td>
                            <td class='px-6 py-4 text-sm text-gray-900'>{{ $tx->user?->name ?? $tx->donation?->donor?->name ?? 'Guest' }}</td>
                            <td class='px-6 py-4 text-sm font-medium text-gray-900'>৳{{ number_format($tx->amount, 2) }} <span class="text-xs text-gray-500">{{ $tx->currency }}</span></td>
                            <td class='px-6 py-4 text-sm text-gray-700'>{{ $tx->gateway_name ?? $tx->gateway }}</td>
                            <td class='px-6 py-4'>
                                @php
                                    $badge = match($tx->status) {
                                        'successful' => 'bg-green-100 text-green-800 border-green-200',
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'failed' => 'bg-red-100 text-red-800 border-red-200',
                                        'cancelled' => 'bg-gray-100 text-gray-700 border-gray-200',
                                        'refunded' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        default => 'bg-gray-100 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <span class='inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}'>{{ strtoupper($tx->status) }}</span>
                            </td>
                            <td class='px-6 py-4 text-sm text-gray-600'>{{ $tx->created_at->format('M d, Y') }}</td>
                            <td class='px-6 py-4 text-sm'><a href='{{ route('admin.transactions.show', $tx) }}' class='inline-flex items-center px-3 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg text-xs font-medium border border-emerald-200'>View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan='7' class='px-6 py-8 text-center text-sm text-gray-500'>No transactions found. Try adjusting filters.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t">{{ $transactions->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
