@extends('layouts.admin')

@section('title', 'Donation Funds')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>Donation Funds</h1>
        <a href='{{ route('admin.donation-funds.create') }}' class='bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded'>Create Fund</a>
    </div>

    <form method="GET" class="mb-6 flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search funds..." class="border rounded px-3 py-2 flex-1">
        <select name="is_active" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="1" {{ request('is_active')==='1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('is_active')==='0' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    @if(session('success'))
        <div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6'>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6'>{{ session('error') }}</div>
    @endif

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Name (BN / EN)</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Minimum</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Donations</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Status</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Actions</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($funds as $fund)
                    <tr>
                        <td class='px-6 py-4'>
                            <div class='text-sm font-medium text-gray-900'>{{ $fund->name_bn }}</div>
                            <div class='text-sm text-gray-500'>{{ $fund->name_en }}</div>
                        </td>
                        <td class='px-6 py-4 text-sm text-gray-500'>৳{{ number_format($fund->minimum_amount, 2) }}</td>
                        <td class='px-6 py-4 text-sm text-gray-500'>{{ $fund->donations_count }}</td>
                        <td class='px-6 py-4'>
                            @if($fund->is_active)
                                <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>Active</span>
                            @else
                                <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'>Inactive</span>
                            @endif
                        </td>
                        <td class='px-6 py-4 text-sm font-medium flex gap-2'>
                            <a href='{{ route('admin.donation-funds.edit', $fund) }}' class='text-indigo-600 hover:text-indigo-900'>Edit</a>
                            <form action='{{ route('admin.donation-funds.toggle', $fund) }}' method='POST' class="inline">
                                @csrf
                                <button type='submit' class='text-yellow-600 hover:text-yellow-900'>Toggle</button>
                            </form>
                            <form action='{{ route('admin.donation-funds.destroy', $fund) }}' method='POST' class='inline' onsubmit='return confirm("Are you sure?")'>
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='text-red-600 hover:text-red-900'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan='5' class='px-6 py-4 text-center text-sm text-gray-500'>No funds found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $funds->links() }}</div>
    </div>
</div>
@endsection
