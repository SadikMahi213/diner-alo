@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <h1 class='text-3xl font-bold text-gray-800 mb-6'>Orders</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search order ID or customer..." class="border rounded px-3 py-2 flex-1">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            @foreach(['pending','processing','successful','failed','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Order ID</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Customer</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Package</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Amount</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Status</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Date</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Action</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($orders as $order)
                    <tr>
                        <td class='px-6 py-4 font-mono text-xs'>{{ $order->transaction_id }}</td>
                        <td class='px-6 py-4 text-sm'>{{ $order->user?->name }}<br><span class="text-xs text-gray-500">{{ $order->user?->email }}</span></td>
                        <td class='px-6 py-4 text-sm'>{{ $order->package?->title ?? 'N/A' }}</td>
                        <td class='px-6 py-4 text-sm'>৳{{ number_format($order->amount, 2) }}</td>
                        <td class='px-6 py-4'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status=='successful' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}'>{{ $order->status }}</span></td>
                        <td class='px-6 py-4 text-sm'>{{ $order->created_at->format('M d, Y') }}</td>
                        <td class='px-6 py-4 text-sm'><a href='{{ route('admin.orders.show', $order) }}' class='text-indigo-600 hover:text-indigo-900'>View</a></td>
                    </tr>
                @empty
                    <tr><td colspan='7' class='px-6 py-4 text-center text-sm text-gray-500'>No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $orders->links() }}</div>
    </div>
</div>
@endsection
