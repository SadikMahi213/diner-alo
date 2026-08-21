@extends('layouts.admin')

@section('title', 'Manage Packages')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>Packages</h1>
        <a href='{{ route('admin.packages.create') }}' class='bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded'>Create Package</a>
    </div>
    
    @if(session('success'))
        <div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6'>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6'>
            {{ session('error') }}
        </div>
    @endif

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Title</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Price</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Status</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Courses</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Actions</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($packages as $package)
                    <tr>
                        <td class='px-6 py-4 whitespace-nowrap'>
                            <div class='text-sm font-medium text-gray-900'>{{ $package->title }}</div>
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                            ৳{{ number_format($package->price, 2) }}
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap'>
                            @if($package->is_active)
                                <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>
                                    Active
                                </span>
                            @else
                                <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                            {{ $package->courses->count() }} courses
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>
                            <a href='{{ route('admin.packages.edit', $package) }}' class='text-indigo-600 hover:text-indigo-900 mr-3'>Edit</a>
                            <form action='{{ route('admin.packages.destroy', $package) }}' method='POST' class='inline' onsubmit='return confirm("Are you sure?")'>
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='text-red-600 hover:text-red-900'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='5' class='px-6 py-4 text-center text-sm text-gray-500'>
                            No packages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $packages->links() }}
        </div>
    </div>
</div>
@endsection
