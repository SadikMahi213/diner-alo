@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>Order {{ $order->transaction_id }}</h1>
        <a href='{{ route('admin.orders.index') }}' class='bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded'>Back</a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6 space-y-4'>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><span class="font-bold">Customer:</span> {{ $order->user?->name }} ({{ $order->user?->email }})</div>
            <div><span class="font-bold">Package:</span> {{ $order->package?->title }} — ৳{{ number_format($order->amount, 2) }}</div>
            <div><span class="font-bold">Status:</span> <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>{{ $order->status }}</span></div>
            <div><span class="font-bold">Payment:</span> {{ $order->payment_method }} ({{ $order->gateway }})</div>
            <div><span class="font-bold">Gateway TX:</span> {{ $order->gateway_transaction_id ?? 'N/A' }}</div>
            <div><span class="font-bold">Session:</span> {{ $order->gateway_session_id }}</div>
            <div><span class="font-bold">Created:</span> {{ $order->created_at->format('Y-m-d H:i:s') }}</div>
        </div>
        <div class="mt-6">
            <h3 class="font-bold">Courses in Package</h3>
            <ul class="list-disc list-inside">
                @forelse($order->package?->courses ?? [] as $course)
                    <li>{{ $course->name }}</li>
                @empty
                    <li>No courses</li>
                @endforelse
            </ul>
        </div>
        <div class="mt-6">
            <h3 class="font-bold">Transactions</h3>
            <table class='min-w-full divide-y divide-gray-200 mt-2'>
                <thead class='bg-gray-50'>
                    <tr>
                        <th class='px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase'>TX ID</th>
                        <th class='px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase'>Amount</th>
                        <th class='px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase'>Status</th>
                        <th class='px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase'>Gateway</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->transactions as $tx)
                        <tr>
                            <td class='px-4 py-2 font-mono text-xs'>{{ $tx->transaction_id }}</td>
                            <td class='px-4 py-2'>৳{{ number_format($tx->amount, 2) }}</td>
                            <td class='px-4 py-2'>{{ $tx->status }}</td>
                            <td class='px-4 py-2'>{{ $tx->gateway_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
