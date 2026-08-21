@extends('layouts.admin')

@section('title', 'Transaction Details')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>Transaction {{ $transaction->transaction_id }}</h1>
        <a href='{{ route('admin.transactions.index') }}' class='bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded'>Back</a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6 space-y-4'>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><span class="font-bold">Amount:</span> ৳{{ number_format($transaction->amount, 2) }} {{ $transaction->currency }}</div>
            <div><span class="font-bold">Status:</span> <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>{{ $transaction->status }}</span></div>
            <div><span class="font-bold">Gateway:</span> {{ $transaction->gateway_name }} ({{ $transaction->gateway }})</div>
            <div><span class="font-bold">Gateway TX:</span> {{ $transaction->gateway_transaction_id ?? 'N/A' }}</div>
            <div><span class="font-bold">Session:</span> {{ $transaction->gateway_session_id }}</div>
            <div><span class="font-bold">User:</span> {{ $transaction->user?->name ?? 'Guest' }} ({{ $transaction->user?->email }})</div>
            <div><span class="font-bold">Donation:</span> {{ $transaction->donation?->transaction_id ?? 'N/A' }}</div>
            <div><span class="font-bold">Order:</span> {{ $transaction->order?->transaction_id ?? 'N/A' }}</div>
            <div><span class="font-bold">Created:</span> {{ $transaction->created_at->format('Y-m-d H:i:s') }}</div>
            <div><span class="font-bold">Updated:</span> {{ $transaction->updated_at->format('Y-m-d H:i:s') }}</div>
        </div>
        @if($transaction->gateway_response)
            <div>
                <h3 class="font-bold mt-4">Gateway Response</h3>
                <pre class="bg-gray-100 p-4 rounded text-xs overflow-auto">{{ json_encode(json_decode($transaction->gateway_response), JSON_PRETTY_PRINT) }}</pre>
            </div>
        @endif
        @if($transaction->failure_reason)
            <div class="bg-red-50 border border-red-200 p-4 rounded">
                <span class="font-bold">Failure Reason:</span> {{ $transaction->failure_reason }}
            </div>
        @endif
        <div class="flex gap-4 mt-6">
            @if($transaction->donation)
                <a href="{{ route('donation.receipt', $transaction->donation->id) }}" class="text-indigo-600 hover:text-indigo-900">View Receipt</a>
            @endif
            @if($transaction->order)
                <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900">View Orders</a>
            @endif
        </div>
    </div>
</div>
@endsection
