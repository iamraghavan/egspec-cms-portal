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
                        <form method="POST" action="{{ route('sp.event.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="title">Event Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Event title *" required spellcheck="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="venue">Venue</label>
                                        <input class="form-control" type="text" name="venue" placeholder="Venue name *" required spellcheck="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="date">Date</label>
                                        <input class="form-control" type="date" name="date" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="time">Time</label>
                                        <input class="form-control" type="time" name="time" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="department">Department</label>
                                        <select name="department" id="department" class="form-select" required>
                                            <option value="">Select Department</option>
                                            <option value="MECH">Mechanical Engineering</option>
                                            <option value="CIVIL">Civil Engineering</option>
                                            <option value="EEE">Electrical and Electronics Engineering</option>
                                            <option value="ECE">Electronics and Communication Engineering</option>
                                            <option value="CSE">Computer Science and Engineering</option>
                                            <option value="IT">Information Technology</option>
                                            <option value="BME">Biomedical Engineering</option>
                                            <option value="CSBS">Computer Science & Business Systems Engineering</option>
                                            <option value="AIDS">Artificial Intelligence and Data Science</option>
                                            <option value="Placement">Placement</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="event_image">Event Image (max 1MB, only .webp)</label>
                                        <input type="file" name="event_image" class="form-control" accept=".webp">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="event_url">Event URL (optional)</label>
                                        <input type="url" name="event_url" class="form-control" placeholder="https://symposium.egspec.org">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="attachment">Attachement - Google Drive URL (optional)</label>
                                        <input type="url" name="attachment" class="form-control" placeholder="https://drive.google.com/your-link">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success me-3">Add Event</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
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



@endsection
