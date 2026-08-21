@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <h1 class='text-3xl font-bold text-gray-800 mb-6'>Users</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="border rounded px-3 py-2 flex-1">
        <select name="role" class="border rounded px-3 py-2">
            <option value="">All Roles</option>
            <option value="user" {{ request('role')=='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Name</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Email</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Role</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Joined</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Action</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($users as $user)
                    <tr>
                        <td class='px-6 py-4 text-sm font-medium text-gray-900'>{{ $user->name }}</td>
                        <td class='px-6 py-4 text-sm text-gray-500'>{{ $user->email }}</td>
                        <td class='px-6 py-4'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role=='admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}'>{{ $user->role }}</span></td>
                        <td class='px-6 py-4 text-sm'>{{ $user->created_at->format('M d, Y') }}</td>
                        <td class='px-6 py-4 text-sm'><a href='{{ route('admin.users.show', $user) }}' class='text-indigo-600 hover:text-indigo-900'>View</a></td>
                    </tr>
                @empty
                    <tr><td colspan='5' class='px-6 py-4 text-center text-sm text-gray-500'>No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $users->links() }}</div>
    </div>
</div>
@endsection
