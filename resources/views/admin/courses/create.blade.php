@extends('layouts.admin')

@section('title', 'Create Course')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class='flex justify-between items-center mb-6'>
        <h1 class='text-3xl font-bold text-gray-800'>Create Course</h1>
        <a href='{{ route('admin.courses.index') }}' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'>Back</a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6'>
        <form action='{{ route('admin.courses.store') }}' method='POST'>
            @csrf
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Name *</label>
                <input type='text' name='name' value="{{ old('name') }}" class='shadow border rounded w-full py-2 px-3' required>
                @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Short Description</label>
                <textarea name='short_description' class='shadow border rounded w-full py-2 px-3'>{{ old('short_description') }}</textarea>
            </div>
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Teacher</label>
                <select name='teacher_id' class='shadow border rounded w-full py-2 px-3'>
                    <option value="">No Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id')==$teacher->id ? 'selected' : '' }}>{{ $teacher->name }} ({{ $teacher->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Status *</label>
                <select name='status' class='shadow border rounded w-full py-2 px-3' required>
                    <option value="draft" {{ old('status')=='draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status')=='published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status')=='archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <button type='submit' class='bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded'>Create Course</button>
        </form>
    </div>
</div>
@endsection
