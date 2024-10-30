@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">
    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard')))],
            ['name' => 'Website'],
            ['name' => 'Newspaper Cuts']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-product-header">
                                <div>
                                    <a class="btn btn-primary" href="">
                                        <i class="fa fa-plus"></i> Add Newspaper Cut's
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="table display datatable" id="events-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Newspaper Name</th>
                                            <th>Date of Publish</th>
                                            <th>Uploaded By</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($newspcc as $index => $newspccs)
                                            <tr>
                                                <td>{{ $newspcc->firstItem() + $index }}</td>
                                                <td>{{ $newspccs->newspaper_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($newspccs->date_of_publish)->format('d-m-Y') }}</td>
                                                <td>
                                                    @php
                                                        $badgeClasses = [
                                                            'super_admin' => 'badge-light-success',
                                                            'admin' => 'badge-light-danger',
                                                            'coordinator' => 'badge-light-warning',
                                                            'staff' => 'badge-light-danger',
                                                            'student' => 'badge-light-warning',
                                                        ];
                                                        $role = $newspccs->user->role->name ?? 'N/A';
                                                        $badgeClass = $badgeClasses[$role] ?? 'badge-light-danger';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $newspccs->user->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>{{ $newspccs->department }}</td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a target="_blank" referrerpolicy="origin" class="btn btn-outline-info"  href=" ?id= &source=edit#view-section">
                                                                view
                                                            </a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="" method="POST" style="display:inline;" id="delete-form-">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="btn btn-outline-danger" onclick="confirmDelete('');">
                                                                    delete
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



