@extends('layouts.admin')

@section('title', 'Edit Package')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class='flex justify-between items-center mb-6'>
        <h1 class='text-3xl font-bold text-gray-800'>Edit Package</h1>
        <a href='{{ route('admin.packages') }}' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'>
            Back to Packages
        </a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6'>
        <form action='{{ route('admin.packages.update', $package) }}' method='POST'>
            @csrf
            @method('PUT')
            
            <div class='mb-4'>
                <label for='title' class='block text-gray-700 text-sm font-bold mb-2'>Title</label>
                <input type='text' name='title' id='title' value='{{ old('title', $package->title) }}' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' required>
            </div>
            
            <div class='mb-4'>
                <label for='description' class='block text-gray-700 text-sm font-bold mb-2'>Description</label>
                <textarea name='description' id='description' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'>{{ old('description', $package->description) }}</textarea>
            </div>
            
            <div class='mb-4'>
                <label for='price' class='block text-gray-700 text-sm font-bold mb-2'>Price (৳)</label>
                <input type='number' name='price' id='price' step='0.01' min='0' value='{{ old('price', $package->price) }}' class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' required>
            </div>
            
            <div class='mb-4'>
                <label for='is_active' class='block text-gray-700 text-sm font-bold mb-2'>
                    <input type='checkbox' name='is_active' id='is_active' value="1" class='mr-2 leading-tight' {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                    Is Active
                </label>
            </div>
            
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Courses</label>
                <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4'>
                    @foreach($courses as $course)
                        <div class='flex items-center'>
                            <input type='checkbox' name='courses[]' value='{{ $course->id }}' id='course_{{ $course->id }}' class='mr-2' {{ in_array($course->id, old('courses', $packageCourses)) ? 'checked' : '' }}>
                            <label for='course_{{ $course->id }}' class='text-gray-700'>{{ $course->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class='flex items-center justify-between'>
                <button type='submit' class='bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'>
                    Update Package
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
