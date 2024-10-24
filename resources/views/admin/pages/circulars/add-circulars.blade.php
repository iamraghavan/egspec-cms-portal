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
                                <form method="POST" action="{{ route('sp.circular.post') }}" id="circularForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title here..." required minlength="10" maxlength="90">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="circular_content">Circular Content</label>
                                                <textarea id="circular_content" class="form-control" name="circular_content" required>{{ old('circular_content') }}</textarea>
                                                @error('circular_content')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
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
                                                    <option value="COE">Controller of Examination</option>
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



<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
        const editor = SUNEDITOR.create('circular_content', {
            showPathLabel: false,
            charCounter: true,
            maxCharCount: 720,
            width: 'auto',
            maxWidth: '700px',
            height: 400,
            minHeight: '100px',
            maxHeight: '250px',
            buttonList: [
                ['undo', 'redo', 'font', 'fontSize', 'formatBlock','fontColor', 'hiliteColor', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'table','bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat','link',  'fullScreen', 'preview', 'print', 'save'],

            ],
            callBackSave: function(contents, isChanged) {
                console.log(contents);
            }
        });

        // Listen to input events on the editor
        editor.onChange = function(contents, core) {
            // Update the underlying textarea
            editor.save();
            console.log(document.getElementById("circular_content").value);
        };

        // Attach form submission handler
        document.getElementById('circularForm').addEventListener('submit', validateForm);
    });
</script>
@endsection
