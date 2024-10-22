@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">

    <x-h-nav/>
    <div class="page-body">


        <x-breadcrumb :items="[
        ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
        ['name' => 'Website'],
        ['name' => 'Event'],
        ['name' => 'Add Event']
    ]" />


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form action="{{ route('sp.events.update', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Event Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Event Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Venue -->
                            <div class="mb-3">
                                <label for="venue" class="form-label">Venue</label>
                                <input type="text" name="venue" id="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ old('venue', $event->venue) }}" required>
                                @error('venue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date and Time -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $event->date) }}" required>
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $event->time) }}" required>
                                        @error('time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select @error('department') is-invalid @enderror" required>
                                    <option value="" disabled>Select Department</option>
                                    <option value="MECH" {{ old('department', $event->department) == 'MECH' ? 'selected' : '' }}>Mechanical Engineering</option>
                                    <option value="CIVIL" {{ old('department', $event->department) == 'CIVIL' ? 'selected' : '' }}>Civil Engineering</option>
                                    <!-- Add more departments here -->
                                </select>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Event Image -->
                            <div class="mb-3">
                                <label for="event_image" class="form-label">Event Image (max 1MB, only .webp)</label>
                                <input type="file" name="event_image" id="event_image" class="form-control @error('event_image') is-invalid @enderror" accept=".webp">
                                @error('event_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Optional Fields -->
                            <div class="mb-3">
                                <label for="event_url" class="form-label">Event URL (optional)</label>
                                <input type="url" name="event_url" id="event_url" class="form-control" value="{{ old('event_url', $event->event_url) }}">
                            </div>
                            <div class="mb-3">
                                <label for="attachment" class="form-label">Attachment - Google Drive URL (optional)</label>
                                <input type="url" name="attachment" id="attachment" class="form-control" value="{{ old('attachment', $event->attachment) }}">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success me-3">Update Event</button>
                                <button type="button" class="btn btn-danger" onclick="cancelConfirmation()">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>




    <x-footer/>

</div>

<script>
   function cancelConfirmation() {
        swal({
            title: 'Are you sure?',
            text: "You haven't saved your changes. Do you want to leave this page?",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "Cancel",
                    visible: true,
                    className: "btn btn-danger"
                },
                confirm: {
                    text: "Yes, leave",
                    className: "btn btn-success"
                }
            },
            dangerMode: true,
        }).then((willLeave) => {
            if (willLeave) {
                // Redirect back to the previous page
                window.history.back();
            }
        });
    }
</script>






@endsection
