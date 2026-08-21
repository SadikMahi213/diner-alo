@extends('layouts.admin')

@section('title', 'Donations')

@section('content')
<div class="container mx-auto px-4 py-8 text-gray-900">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Donations</h1>
        <a href="{{ route('admin.export.donations') }}?{{ http_build_query(request()->query()) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium">Export CSV</a>
    </div>

    <!-- Summary Cards -->
    @php
        $total = \App\Models\Donation::count();
        $successful = \App\Models\Donation::where('status','successful')->count();
        $pending = \App\Models\Donation::where('status','pending')->count() + \App\Models\Donation::where('status','processing')->count();
        $failed = \App\Models\Donation::whereIn('status',['failed','cancelled','refunded'])->count();
        $totalAmount = \App\Models\Donation::where('status','successful')->sum('amount');
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($total) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Successful</p>
            <p class="text-2xl font-bold text-emerald-600">{{ number_format($successful) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Pending/Processing</p>
            <p class="text-2xl font-bold text-amber-600">{{ number_format($pending) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Failed/Cancelled</p>
            <p class="text-2xl font-bold text-red-600">{{ number_format($failed) }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm">
            <p class="text-xs text-gray-500 uppercase">Total Amount</p>
            <p class="text-xl font-bold text-emerald-700">৳{{ number_format($totalAmount, 2) }}</p>
        </div>
    </div>

    <!-- Filters -->
    <form method="GET" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="TX ID / donor / email / mobile" class="bg-white text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <select name="status" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Status</option>
                @foreach(['pending','processing','successful','failed','cancelled','refunded'] as $s)
                    <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ strtoupper($s) }}</option>
                @endforeach
            </select>
            <select name="fund" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Funds</option>
                @foreach(\App\Models\DonationFund::orderBy('name_en')->get() as $f)
                    <option value="{{ $f->id }}" {{ request('fund')==$f->id ? 'selected' : '' }}>{{ $f->name_en }} / {{ $f->name_bn }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <select name="gateway" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">All Gateways</option>
                <option value="sslcommerz" {{ request('gateway')=='sslcommerz' ? 'selected' : '' }}>SSLCommerz</option>
                <option value="manual" {{ request('gateway')=='manual' ? 'selected' : '' }}>Manual</option>
            </select>
        </div>
        <div class="flex gap-2 mt-3">
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-medium">Search</button>
            <a href="{{ route('admin.donations') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium">Reset</a>
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Transaction ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Donor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Fund / Project</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Gateway</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($donations as $donation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-mono text-xs text-gray-800">{{ $donation->transaction_id }}</td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $donation->donor?->name ?? 'Guest' }}</div>
                                <div class="text-xs text-gray-500">{{ $donation->donor?->email }} @if($donation->donor?->mobile_number) • {{ $donation->donor->mobile_number }} @endif</div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="text-gray-900">{{ $donation->fund?->name_en ?? $donation->fund?->name_bn ?? '—' }}</div>
                                <div class="text-xs text-gray-500">{{ $donation->project?->title ?? '—' }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">৳{{ number_format($donation->amount, 2) }} <span class="text-xs text-gray-500">{{ $donation->currency ?? 'BDT' }}</span></td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $donation->payment_method ?? $donation->gateway ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $badge = match($donation->status) {
                                        'successful' => 'bg-green-100 text-green-800 border-green-200',
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'failed' => 'bg-red-100 text-red-800 border-red-200',
                                        'cancelled' => 'bg-gray-100 text-gray-700 border-gray-200',
                                        default => 'bg-gray-100 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">{{ strtoupper($donation->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $donation->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm flex gap-2">
                                <a href="{{ route('admin.donations.show', $donation) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">View</a>
                                <a href="{{ route('donation.receipt', $donation) }}" class="text-gray-600 hover:text-gray-800">Receipt</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-12 text-center text-sm text-gray-500">No donations found. Try adjusting filters.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4 border-t bg-gray-50">
            {{ $donations->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
