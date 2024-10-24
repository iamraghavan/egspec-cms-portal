@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">
    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard')))],
            ['name' => 'Website'],
            ['name' => 'Circulars']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-product-header">
                                <div>
                                    <a class="btn btn-primary" href="{{ route('sp.circular.create') }}">
                                        <i class="fa fa-plus"></i> Add Circular
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="table display datatable" id="events-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Circular Title</th>
                                            <th>Department</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($circulars as $index => $circular)
                                            <tr>
                                                <td>{{ $circulars->firstItem() + $index }}</td>
                                                <td>{{ $circular->title }}</td>
                                                <td>{{ $circular->department }}</td>
                                                <td>
                                                    @php
                                                        $badgeClasses = [
                                                            'super_admin' => 'badge-light-success',
                                                            'admin' => 'badge-light-danger',
                                                            'coordinator' => 'badge-light-warning',
                                                            'staff' => 'badge-light-danger',
                                                            'student' => 'badge-light-warning',
                                                        ];
                                                        $role = $circular->user->role->name ?? 'N/A';
                                                        $badgeClass = $badgeClasses[$role] ?? 'badge-light-danger';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $circular->user->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a target="_blank" referrerpolicy="origin" href="{{ route('sp.circular.edit') }}?id={{ $circular->circular_id }}&source=edit#edit-section">
                                                                <i data-feather="edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ route('sp.circular.destroy', ['circular' => $circular->circular_id]) }}" method="POST" style="display:inline;" id="delete-form-{{ $circular->circular_id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" onclick="confirmDelete('{{ $circular->circular_id }}');">
                                                                    <i data-feather="trash"></i>
                                                                </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer/>

    @endsection



