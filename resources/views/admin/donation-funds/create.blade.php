@extends('layouts.admin')

@section('title', 'Create Donation Fund')

@section('content')
<div class='container mx-auto px-4 py-8'>
    <div class='flex justify-between items-center mb-6'>
        <h1 class='text-3xl font-bold text-gray-800'>Create Donation Fund</h1>
        <a href='{{ route('admin.donation-funds.index') }}' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'>Back</a>
    </div>

    <div class='bg-white shadow-md rounded-lg p-6'>
        <form action='{{ route('admin.donation-funds.store') }}' method='POST'>
            @csrf
            <div class='grid grid-cols-1 md:grid-cols-2 gap-4'>
                <div class='mb-4'>
                    <label class='block text-gray-700 text-sm font-bold mb-2'>Name BN *</label>
                    <input type='text' name='name_bn' value="{{ old('name_bn') }}" class='shadow border rounded w-full py-2 px-3' required>
                    @error('name_bn') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class='mb-4'>
                    <label class='block text-gray-700 text-sm font-bold mb-2'>Name EN *</label>
                    <input type='text' name='name_en' value="{{ old('name_en') }}" class='shadow border rounded w-full py-2 px-3' required>
                </div>
            </div>
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Slug</label>
                <input type='text' name='slug' value="{{ old('slug') }}" placeholder="auto-generated from EN name" class='shadow border rounded w-full py-2 px-3'>
            </div>
            <div class='mb-4'>
                <label class='block text-gray-700 text-sm font-bold mb-2'>Description</label>
                <textarea name='description' class='shadow border rounded w-full py-2 px-3'>{{ old('description') }}</textarea>
            </div>
            <div class='grid grid-cols-1 md:grid-cols-2 gap-4'>
                <div class='mb-4'>
                    <label class='block text-gray-700 text-sm font-bold mb-2'>Category</label>
                    <select name='category_id' class='shadow border rounded w-full py-2 px-3'>
                        <option value="">No Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>{{ $cat->name_en }} / {{ $cat->name_bn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='mb-4'>
                    <label class='block text-gray-700 text-sm font-bold mb-2'>Minimum Amount (৳) *</label>
                    <input type='number' name='minimum_amount' step='0.01' value="{{ old('minimum_amount', 100) }}" class='shadow border rounded w-full py-2 px-3' required>
                </div>
            </div>
            <div class='mb-4'>
                <label class='flex items-center'>
                    <input type='checkbox' name='is_active' value="1" class='mr-2' {{ old('is_active', true) ? 'checked' : '' }}> Is Active
                </label>
            </div>
            <button type='submit' class='bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded'>Create Fund</button>
        </form>
    </div>
</div>
@endsection
