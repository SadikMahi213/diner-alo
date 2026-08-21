@extends('layouts.admin')

@section('title', 'Courses')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class="flex justify-between items-center mb-6">
        <h1 class='text-3xl font-bold text-gray-800'>Courses</h1>
        <a href='{{ route('admin.courses.create') }}' class='bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded'>Create Course</a>
    </div>

    <form method="GET" class="mb-6 flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..." class="border rounded px-3 py-2 flex-1">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
            <option value="archived" {{ request('status')=='archived' ? 'selected' : '' }}>Archived</option>
        </select>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    @if(session('success'))
        <div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6'>{{ session('success') }}</div>
    @endif

    <div class='bg-white shadow-md rounded-lg overflow-hidden'>
        <table class='min-w-full divide-y divide-gray-200'>
            <thead class='bg-gray-50'>
                <tr>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Name</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Teacher</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Status</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Students</th>
                    <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase'>Actions</th>
                </tr>
            </thead>
            <tbody class='bg-white divide-y divide-gray-200'>
                @forelse($courses as $course)
                    <tr>
                        <td class='px-6 py-4'>
                            <div class='text-sm font-medium text-gray-900'>{{ $course->name }}</div>
                            <div class='text-sm text-gray-500'>{{ Str::limit($course->short_description, 50) }}</div>
                        </td>
                        <td class='px-6 py-4 text-sm'>{{ $course->teacher?->name ?? 'N/A' }}</td>
                        <td class='px-6 py-4'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $course->status=='published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}'>{{ $course->status }}</span></td>
                        <td class='px-6 py-4 text-sm'>{{ $course->students_count }}</td>
                        <td class='px-6 py-4 text-sm flex gap-2'>
                            <a href='{{ route('admin.courses.edit', $course) }}' class='text-indigo-600 hover:text-indigo-900'>Edit</a>
                            <form action='{{ route('admin.courses.destroy', $course) }}' method='POST' class='inline' onsubmit='return confirm("Are you sure?")'>
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='text-red-600 hover:text-red-900'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan='5' class='px-6 py-4 text-center text-sm text-gray-500'>No courses found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $courses->links() }}</div>
    </div>
</div>
@endsection
