@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Newspaper Cutout Details</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Newspaper Name</td>
                <td>{{ $newspcc->newspaper_name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $newspcc->description }}</td>
            </tr>
            <tr>
                <td>Date of Publish</td>
                <td>{{ \Carbon\Carbon::parse($newspcc->date_of_publish)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    @if($newspcc->image_path)
                        <img src="https://egspec.org/assets/storage/{{$newspcc->image_path}}" alt="Newspaper Image" style="max-width: 200px;">
                    @else
                        No image available
                    @endif
                </td>
            </tr>
            <tr>
                <td>Department</td>
                <td>{{ $newspcc->department }}</td>
            </tr>
            <tr>
                <td>Uploaded By</td>
                <td>{{ $newspcc->user->name }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('sa_newspcc_index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
