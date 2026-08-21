@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>User: {{ $user->name }}</h1>
        <a href='{{ route('admin.users.index') }}' class='bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded'>Back</a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6 space-y-4'>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><span class="font-bold">Email:</span> {{ $user->email }}</div>
            <div><span class="font-bold">Role:</span> {{ $user->role }}</div>
            <div><span class="font-bold">Joined:</span> {{ $user->created_at->format('Y-m-d H:i:s') }}</div>
            <div><span class="font-bold">Orders:</span> {{ $user->orders->count() }} ({{ $user->orders->where('status','successful')->count() }} successful)</div>
            <div><span class="font-bold">Transactions:</span> {{ $user->transactions->count() }}</div>
            <div><span class="font-bold">Courses:</span> {{ $user->courses->count() }}</div>
            <div><span class="font-bold">Wallet:</span> ৳{{ number_format($user->wallet?->balance ?? 0, 2) }}</div>
        </div>

        <div class="mt-6">
            <h3 class="font-bold">Recent Orders</h3>
            <table class='min-w-full divide-y divide-gray-200 mt-2'>
                <thead class='bg-gray-50'>
                    <tr><th class='px-4 py-2 text-left text-xs'>Order ID</th><th class='px-4 py-2 text-left text-xs'>Package</th><th class='px-4 py-2 text-left text-xs'>Amount</th><th class='px-4 py-2 text-left text-xs'>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($user->orders->take(5) as $order)
                        <tr><td class='px-4 py-2 font-mono text-xs'>{{ $order->transaction_id }}</td><td class='px-4 py-2'>{{ $order->package?->title }}</td><td class='px-4 py-2'>৳{{ number_format($order->amount,2) }}</td><td class='px-4 py-2'>{{ $order->status }}</td></tr>
                    @empty
                        <tr><td colspan='4' class='px-4 py-2 text-center text-sm'>No orders</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <h3 class="font-bold">Recent Transactions</h3>
            <table class='min-w-full divide-y divide-gray-200 mt-2'>
                <thead class='bg-gray-50'>
                    <tr><th class='px-4 py-2 text-left text-xs'>TX ID</th><th class='px-4 py-2 text-left text-xs'>Amount</th><th class='px-4 py-2 text-left text-xs'>Status</th><th class='px-4 py-2 text-left text-xs'>Gateway</th></tr>
                </thead>
                <tbody>
                    @forelse($user->transactions->take(5) as $tx)
                        <tr><td class='px-4 py-2 font-mono text-xs'>{{ $tx->transaction_id }}</td><td class='px-4 py-2'>৳{{ number_format($tx->amount,2) }}</td><td class='px-4 py-2'>{{ $tx->status }}</td><td class='px-4 py-2'>{{ $tx->gateway_name }}</td></tr>
                    @empty
                        <tr><td colspan='4' class='px-4 py-2 text-center text-sm'>No transactions</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
