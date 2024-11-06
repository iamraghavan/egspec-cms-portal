<!-- resources/views/admin/pages/category/create_category.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Category</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('sa_categories_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="keywords">Keywords (comma separated)</label>
                <input type="text" id="keywords" name="keywords" class="form-control">
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Category (optional)</label>
                <input type="text" id="parent_id" name="parent_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="category_order">Category Order</label>
                <input type="number" id="category_order" name="category_order" class="form-control" value="0">
            </div>

            <div class="form-group">
                <label for="show_on_menu">Show on Menu</label>
                <select id="show_on_menu" name="show_on_menu" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Category</button>
        </form>
    </div>
@endsection
