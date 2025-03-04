@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">
    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
            ['name' => 'Blog'],
            ['name' => 'Categories']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-product-header">
                                <div>
                                    <a class="btn btn-primary" href="{{ route('sa_categories_create') }}"><i class="fa fa-plus"></i> Add Category</a>
                                </div>
                            </div>
                            <div class="table-responsive custom-scrollbar">
                                <table class="table display datatable" id="categories-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Category Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Keywords</th>
                                            <th>Order</th>
                                            <th>Show on Menu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $index => $category)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $category['name'] }}</td>
                                                <td>{{ $category['slug'] }}</td>
                                                <td>{{ $category['description'] ?? 'N/A' }}</td>
                                                <td>{{ implode(', ', $category['keywords'] ?? []) }}</td>
                                                <td>{{ $category['category_order'] ?? 'N/A' }}</td>
                                                <td>{{ $category['show_on_menu'] ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="{{ route('sa_categories_edit', $category['_id']) }}">
                                                                <i data-feather="edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ route('sa_categories_destroy', $category['_id']) }}" method="POST" style="display:inline;" id="delete-form-{{ $category['_id'] }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" onclick="confirmDelete('{{ $category['_id'] }}');">
                                                                    <i data-feather="trash"></i>
                                                                </a>
                                                            </form>
                                                        </li>
                                                        <li class="delete">
                                                            <a href="{{ route('sa_sub_categories_index') }}">

                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- Optional pagination --}}
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer/>

        <script>
            function confirmDelete(_id) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById(`delete-form-${_id}`).submit();
                }
            }
            </script>

@endsection
