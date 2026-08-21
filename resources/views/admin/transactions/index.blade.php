@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <h1 class='text-3xl font-bold text-gray-800 mb-6'>Transactions</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search TX ID..." class="border rounded px-3 py-2">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            @foreach(['pending','processing','successful','failed','cancelled','refunded'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <select name="gateway" class="border rounded px-3 py-2">
            <option value="">All Gateways</option>
            <option value="sslcommerz" {{ request('gateway')=='sslcommerz' ? 'selected' : '' }}>SSLCommerz</option>
            <option value="manual" {{ request('gateway')=='manual' ? 'selected' : '' }}>Manual</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="border rounded px-3 py-2">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded px-3 py-2">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Transaction ID</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>User/Donor</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Amount</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Gateway</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Status</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Date</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Action</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($transactions as $tx)
                    <tr>
                        <td class='px-6 py-4 font-mono text-xs'>{{ $tx->transaction_id }}</td>
                        <td class='px-6 py-4 text-sm'>{{ $tx->user?->name ?? $tx->donation?->donor?->name ?? 'Guest' }}</td>
                        <td class='px-6 py-4 text-sm'>৳{{ number_format($tx->amount, 2) }} {{ $tx->currency }}</td>
                        <td class='px-6 py-4 text-sm'>{{ $tx->gateway_name ?? $tx->gateway }}</td>
                        <td class='px-6 py-4'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tx->status=='successful' ? 'bg-green-100 text-green-800' : ($tx->status=='pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}'>{{ $tx->status }}</span></td>
                        <td class='px-6 py-4 text-sm'>{{ $tx->created_at->format('M d, Y') }}</td>
                        <td class='px-6 py-4 text-sm'><a href='{{ route('admin.transactions.show', $tx) }}' class='text-indigo-600 hover:text-indigo-900'>View</a></td>
                    </tr>
                @empty
                    <tr><td colspan='7' class='px-6 py-4 text-center text-sm text-gray-500'>No transactions found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $transactions->links() }}</div>
    </div>
</div>
@endsection
