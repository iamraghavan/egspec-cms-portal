@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">
    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard')))],
            ['name' => 'Website'],
            ['name' => 'Event']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-product-header">
                                <div>
                                    <a class="btn btn-primary" href="{{ route('sp.events.create') }}"><i class="fa fa-plus"></i> Add Event</a>
                                    <button class="btn btn-secondary" id="exportBtn"><i class="fa fa-download"></i> Export</button>
                                    <button class="btn btn-info" id="importBtn"><i class="fa fa-upload"></i> Import</button>
                                </div>
                            </div>
                            <div class="table-responsive custom-scrollbar">
                                <table class="table display datatable" id="events-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Event Title</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Venue</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $index => $event)
                                            <tr>
                                                <td>{{ $events->firstItem() + $index }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->time)->format('H:i:s') }}</td>
                                                <td>{{ $event->venue }}</td>
                                                <td>
                                                    @php
                                                        $badgeClasses = [
                                                            'super_admin' => 'badge-light-success',
                                                            'admin' => 'badge-light-danger',
                                                            'coordinator' => 'badge-light-warning',
                                                            'staff' => 'badge-light-danger',
                                                            'student' => 'badge-light-warning',
                                                        ];
                                                        $role = $event->user->role->name ?? 'N/A';
                                                        $badgeClass = $badgeClasses[$role] ?? 'badge-light-danger';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $event->user->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="">
                                                                <i data-feather="edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ route('sp.events.destroy') }}?id={{ $event->event_id }}" method="POST" style="display:inline;" id="delete-form-{{ $event->event_id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" onclick="confirmDelete('{{ $event->event_id }}');">
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
                            <div class="datatable-bottom">
                                <div class="datatable-info">Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries</div>
                                {{ $events->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer/>


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

            // Handle export button
            $('#exportBtn').on('click', function() {
                // Implement export logic here
                alert('export feature is not yet implemented.');
            });

            // Handle import button
            $('#importBtn').on('click', function() {
                // Implement import logic here
                // You may want to open a modal for file upload
                alert('Import feature is not yet implemented.');
            });
        </script>

    @endsection


