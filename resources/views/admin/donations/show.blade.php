@extends('layouts.admin')

@section('title', 'Donation Details')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Donation {{ $donation->transaction_id }}</h1>
        <a href="{{ route('admin.donations') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Back to Donations</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Donation Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">Transaction ID:</span> <span class="font-mono font-medium text-gray-900">{{ $donation->transaction_id }}</span></div>
                    <div><span class="text-gray-500">Amount:</span> <span class="font-bold text-emerald-700">৳{{ number_format($donation->amount, 2) }} {{ $donation->currency ?? 'BDT' }}</span></div>
                    <div><span class="text-gray-500">Status:</span> <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $donation->status=='successful' ? 'bg-green-100 text-green-800 border-green-200' : ($donation->status=='pending' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : 'bg-red-100 text-red-800 border-red-200') }}">{{ strtoupper($donation->status) }}</span></div>
                    <div><span class="text-gray-500">Date:</span> {{ $donation->created_at->format('M d, Y H:i') }}</div>
                    <div><span class="text-gray-500">Fund:</span> {{ $donation->fund?->name_en ?? $donation->fund?->name_bn ?? '—' }}</div>
                    <div><span class="text-gray-500">Project:</span> {{ $donation->project?->title ?? '—' }}</div>
                    <div><span class="text-gray-500">Anonymous:</span> {{ $donation->is_anonymous ? 'Yes' : 'No' }}</div>
                    @if($donation->message)
                        <div class="md:col-span-2"><span class="text-gray-500">Message:</span> {{ $donation->message }}</div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Payment Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">Gateway:</span> {{ $donation->payment_method ?? $donation->gateway ?? '—' }}</div>
                    <div><span class="text-gray-500">Transaction Status:</span> {{ $donation->transaction?->status ?? '—' }}</div>
                    <div><span class="text-gray-500">Gateway Session ID:</span> <span class="font-mono text-xs">{{ $donation->transaction?->gateway_session_id ?? '—' }}</span></div>
                    <div><span class="text-gray-500">Gateway TX ID:</span> <span class="font-mono text-xs">{{ $donation->transaction?->gateway_transaction_id ?? '—' }}</span></div>
                    <div><span class="text-gray-500">Failure Reason:</span> {{ $donation->transaction?->failure_reason ?? '—' }}</div>
                </div>
                @if($donation->transaction?->gateway_response)
                    <div class="mt-4">
                        <h3 class="font-medium text-gray-700 mb-2">Gateway Response</h3>
                        <details class="bg-gray-50 rounded-lg border">
                            <summary class="px-4 py-2 text-sm font-medium text-gray-600 cursor-pointer hover:bg-gray-100">View Raw Response</summary>
                            <pre class="px-4 py-3 text-xs text-gray-700 overflow-auto max-h-64">{{ json_encode(json_decode($donation->transaction->gateway_response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </details>
                        <p class="text-xs text-gray-400 mt-2">Sensitive fields are redacted in logs. Raw response shown only to authorized admin.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Donor Information</h2>
                <div class="space-y-3 text-sm">
                    <div><span class="text-gray-500">Name:</span> <span class="font-medium text-gray-900">{{ $donation->donor?->name ?? 'Guest' }}</span> @if($donation->is_anonymous) <span class="text-xs text-gray-400">(Anonymous)</span> @endif</div>
                    <div><span class="text-gray-500">Email:</span> {{ $donation->donor?->email ?? '—' }}</div>
                    <div><span class="text-gray-500">Mobile:</span> {{ $donation->donor?->mobile_number ?? '—' }}</div>
                    <div><span class="text-gray-500">User:</span> {{ $donation->user?->name ?? 'Guest' }} {{ $donation->user?->email ? '('.$donation->user->email.')' : '' }}</div>
                </div>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('admin.donors.show', $donation->donor) }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">View Donor →</a>
                    <a href="{{ route('donation.receipt', $donation) }}" class="text-gray-600 hover:text-gray-800 text-sm">Receipt</a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="font-bold text-gray-800 mb-3">Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('donation.receipt', $donation) }}" class="block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg text-sm">View Receipt</a>
                    <a href="{{ route('donation.download-receipt', $donation) }}" class="block w-full text-center bg-white border hover:bg-gray-50 py-2 rounded-lg text-sm">Download Receipt</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
