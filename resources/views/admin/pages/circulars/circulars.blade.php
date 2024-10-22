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
                                        <i class="fa fa-plus"></i> Add Event
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer/>

    @endsection

<style>
    .circular-card {
        border-radius: 50%;
        overflow: hidden;
        height: 300px; /* Adjust height as needed */
        width: 300px; /* Adjust width as needed */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: auto;
    }

    .circular-card .card-body {
        text-align: center;
    }

    .circular-card .action {
        margin-top: 10px;
    }
</style>

<script>
    function confirmDelete(eventId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this event!",
            icon: "warning",
            buttons: {
                cancel: "Cancel",
                confirm: {
                    text: "Delete",
                    value: true,
                    closeModal: true
                }
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-form-' + eventId).submit();
            }
        });
    }
</script>
