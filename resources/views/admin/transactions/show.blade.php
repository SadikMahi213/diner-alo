@extends('layouts.admin')

@section('title', 'Transaction Details')

@section('content')
<div class='container mx-auto px-4 py-8 text-gray-900'>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h1 class='text-2xl md:text-3xl font-bold text-gray-900'>Transaction <span class="font-mono text-emerald-700">{{ $transaction->transaction_id }}</span></h1>
        <a href='{{ route('admin.transactions.index') }}' class='inline-flex items-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium'>Back to Transactions</a>
    </div>

    <div class='bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden'>
        <div class="p-6 space-y-6">
            <!-- Transaction Information -->
            <div>
                <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">Transaction Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</span>
                        <span class="text-lg font-bold text-gray-900">৳{{ number_format($transaction->amount, 2) }} <span class="text-sm font-normal text-gray-500">{{ $transaction->currency }}</span></span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</span>
                        <div>
                            @php
                                $badge = match($transaction->status) {
                                    'successful' => 'bg-green-100 text-green-800 border-green-200',
                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'failed' => 'bg-red-100 text-red-800 border-red-200',
                                    'cancelled' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    default => 'bg-gray-100 text-gray-700 border-gray-200',
                                };
                            @endphp
                            <span class='inline-flex px-3 py-1 text-xs font-bold rounded-full border {{ $badge }}'>{{ strtoupper($transaction->status) }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Gateway</span>
                        <span class="text-gray-900">{{ $transaction->gateway_name ?? $transaction->gateway }} <span class="text-xs text-gray-500">({{ $transaction->gateway }})</span></span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Gateway Transaction ID</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->gateway_transaction_id ?? '—' }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Gateway Session ID</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->gateway_session_id }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Created</span>
                        <span class="text-gray-900">{{ $transaction->created_at->format('M d, Y H:i:s') }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Updated</span>
                        <span class="text-gray-900">{{ $transaction->updated_at->format('M d, Y H:i:s') }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">User / Donor</span>
                        <span class="text-gray-900">{{ $transaction->user?->name ?? $transaction->donation?->donor?->name ?? 'Guest' }}</span>
                        <span class="text-xs text-gray-500">{{ $transaction->user?->email ?? $transaction->donation?->donor?->email ?? '' }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Related Donation</span>
                        <span class="font-mono text-sm text-emerald-700">{{ $transaction->donation?->transaction_id ?? '—' }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Related Order</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->order?->transaction_id ?? '—' }}</span>
                    </div>
                </div>
            </div>

            @if($transaction->failure_reason)
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <h3 class="font-bold text-red-800 mb-1">Failure Reason</h3>
                    <p class="text-sm text-red-700">{{ $transaction->failure_reason }}</p>
                </div>
            @endif

            @if($transaction->gateway_response)
                <div class="border-t pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Gateway Response</h3>
                    <div class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                            @php $gr = json_decode($transaction->gateway_response, true) ?? []; @endphp
                            <div><span class="text-xs text-gray-500 uppercase">Status</span><p class="font-medium text-gray-900">{{ $gr['status'] ?? '—' }}</p></div>
                            <div><span class="text-xs text-gray-500 uppercase">Tran ID</span><p class="font-mono text-xs text-gray-900">{{ $gr['tran_id'] ?? $transaction->gateway_session_id }}</p></div>
                            <div><span class="text-xs text-gray-500 uppercase">Bank TX ID</span><p class="font-mono text-xs text-gray-900">{{ $gr['bank_tran_id'] ?? $gr['gateway_transaction_id'] ?? '—' }}</p></div>
                            <div><span class="text-xs text-gray-500 uppercase">Amount</span><p class="font-medium text-gray-900">৳{{ $gr['amount'] ?? $transaction->amount }} {{ $gr['currency'] ?? $transaction->currency }}</p></div>
                        </div>
                        <details class="group">
                            <summary class="cursor-pointer text-sm font-medium text-emerald-700 hover:text-emerald-800 bg-white border border-gray-200 rounded-lg px-4 py-2 inline-flex items-center gap-2">Raw Gateway Response <span class="text-xs text-gray-500 group-open:hidden">▼</span><span class="text-xs text-gray-500 hidden group-open:inline">▲</span></summary>
                            <pre class="mt-3 bg-gray-900 text-gray-100 p-4 rounded-xl text-xs overflow-auto max-h-80 border border-gray-700">{{ json_encode($gr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </details>
                        <p class="text-xs text-gray-400 mt-2">Sensitive fields (store password, card/CVV) are never logged or displayed.</p>
                    </div>
                </div>
            @endif

            <div class="flex flex-wrap gap-3 pt-4 border-t">
                @if($transaction->donation)
                    <a href="{{ route('donation.receipt', $transaction->donation->id) }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium">View Receipt</a>
                @endif
                @if($transaction->order)
                    <a href="{{ route('admin.orders.show', $transaction->order) }}" class="inline-flex items-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm">View Order</a>
                @endif
                <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
