@extends('layouts.app')
@section('content')

    <div class="container">

        <h2>Update Category</h2>

        <!-- Success/Error message display -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Category Update Form -->
        <form action="{{ route('sa_categories_update', $category['_id']) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category['name']) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Slug -->
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $category['slug']) }}" required>
                @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $category['description'] ?? '') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keywords (Optional) -->
            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" id="keywords" name="keywords" class="form-control" value="{{ old('keywords', implode(', ', $category['keywords'] ?? [])) }}">
                @error('keywords')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Order -->
            <div class="form-group">
                <label for="category_order">Category Order</label>
                <input type="number" id="category_order" name="category_order" class="form-control" value="{{ old('category_order', $category['category_order']) }}" min="0">
                @error('category_order')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Show on Menu -->
            <div class="form-group">
                <label for="show_on_menu">Show on Menu</label>
                <select id="show_on_menu" name="show_on_menu" class="form-control">
                    <option value="1" {{ old('show_on_menu', $category['show_on_menu']) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('show_on_menu', $category['show_on_menu']) == 0 ? 'selected' : '' }}>No</option>
                </select>
                @error('show_on_menu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>

@endsection
