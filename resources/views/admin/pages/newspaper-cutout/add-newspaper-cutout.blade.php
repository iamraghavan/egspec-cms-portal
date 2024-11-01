@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">

    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
            ['name' => 'Website'],
            ['name' => 'Newspaper Cutouts'],
            ['name' => 'Add Newspaper Cutout']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form">
                                <form method="POST" action="{{ route('sp.newspcc.post') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="newspaper_name">Newspaper Name</label>
                                                <input class="form-control" type="text" name="newspaper_name" placeholder="Newspaper Name *" required spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" name="description" rows="4" placeholder="Description of the cutout *" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="date_of_publish">Date of Publish</label>
                                                <input class="form-control" type="date" name="date_of_publish" required>
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
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="image_path">Newspaper Cutout Image (max 1MB, only .webp)</label>
                                                <input type="file" name="image_path" class="form-control" accept=".webp" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success me-3">Add Newspaper Cutout</button>
                                                <button type="button" class="btn btn-danger" onclick="cancelConfirmation()">Cancel</button>
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
                window.history.back();
            }
        });
    }
</script>

@endsection
