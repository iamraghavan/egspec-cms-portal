@extends('layouts.app')

@section('content')

<x-v-nav/>

<div class="page-body-wrapper">
    <x-h-nav/>
    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
            ['name' => 'Website'],
            ['name' => 'Circulars'],
            ['name' => 'Add Circular']
        ]" />

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="circular_content">Circular Content</label>
    <textarea class="form-control" id="circular_content" name="circular_content" placeholder="Enter circular content here..." required spellcheck="false"></textarea>
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
                                                <label for="department">Department</label>
                                                <select name="department" id="department" class="form-select" required>
                                                    <option value="">Select Department</option>
                                                    <option value="COE">Centre of Excellence</option>
                                                    <option value="Principal & Administration">Principal & Administration</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="authorized_signature_person">Authorized Signature Person</label>
                                                <input class="form-control" type="text" name="authorized_signature_person" placeholder="Name of authorized person *" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input class="form-control" type="text" name="slug" placeholder="Unique slug *" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="circular_id">Circular ID</label>
                                                <input class="form-control" type="text" name="circular_id" placeholder="Unique circular ID *" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="circular_attachment">Circular Attachment (max 2MB, only .pdf)</label>
                                                <input type="file" name="circular_attachment" class="form-control" accept=".pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success me-3">Add Circular</button>
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




@endsection
