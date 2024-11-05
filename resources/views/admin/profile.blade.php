@extends('layouts.app')
@section('content')

<x-v-nav />

<div class="page-body-wrapper">

    <x-h-nav />

    <div class="page-body">
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
            ['name' => 'Profile'],
            ['name' => Auth::user()->name]
        ]" />

        <!-- Container-fluid starts-->


        <div class="container-fluid">
            <div class="user-profile social-app-profile">
                <div class="row">
                    <!-- User Profile Card Start -->
                    <div class="col-sm-12 box-col-12">
                        <div class="card hovercard text-center">
                            <div class="cardheader socialheader"></div>
                            <div class="user-image">
                                <div class="avatar">
                                    <img alt="{{ $user->name }}"
     src="{{
         filter_var($user->avatar, FILTER_VALIDATE_URL)
             ? $user->avatar
             : ($user->avatar
                 ? asset($user->avatar)
                 : asset('assets/images/user/default-avatar.jpg'))
     }}">

                                </div>
                            </div>
                            <div class="info market-tabs p-0">
                                <ul class="nav nav-tabs border-tab tabs-scoial" id="top-tab" role="tablist">

                                    <li class="nav-item">
                                        <div class="user-designation"></div>
                                        <div class="title"><a target="_blank" href="#">{{ $user->title ?? '' }} {{ $user->name }}</a></div>
                                        <div class="desc mt-2">{{ $user->profile_role ?? 'No Profile Role' }}</div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- User Profile Card End -->
                </div>
                <div class="container">
                    <h2>Edit Profile</h2>
                    <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{ $user->department }}">
                        </div>

                        <!-- Profile Role -->
                        <div class="mb-3">
                            <label for="profile_role" class="form-label">Profile Role</label>
                            <input type="text" class="form-control" id="profile_role" name="profile_role" value="{{ $user->profile_role }}">
                        </div>

                        <!-- Staff / Student ID -->
                        <div class="mb-3">
                            <label for="staff_student_id" class="form-label">Staff/Student ID</label>
                            <input type="text" class="form-control" id="staff_student_id" name="staff_student_id" value="{{ $user->staff_student_id }}">
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $user->title }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>

                    <hr>

                    <!-- two-factor-authentication.blade.php -->
<form method="POST" action="/user/two-factor-authentication">
    @csrf
    <button type="submit">Enable Two-Factor Authentication</button>
</form>

@if (session('status') == 'two-factor-authentication-enabled')
    <div>
        {!! auth()->user()->twoFactorQrCodeSvg() !!}
    </div>
@endif


@foreach ((array) auth()->user()->recoveryCodes() as $code)
        <div>{{ $code }}</div>
    @endforeach


<form method="POST" action="/user/two-factor-authentication">
    @csrf
    @method('DELETE')
    <button type="submit">Disable Two-Factor Authentication</button>
</form>

                    <!-- Recent Sessions Table -->
                    <h3 class="mt-5">Recent Sessions</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>IP Address</th>
                                <th>Last Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data: Replace with actual session data if available -->
                            <tr>
                                <td>Chrome on Windows</td>
                                <td>192.168.1.1</td>
                                <td>2024-11-02 14:35</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



    </div>

    <x-footer />

</div>





@section('scripts')
    <script>
        // Lazy loading images
        document.addEventListener("DOMContentLoaded", function() {
            const lazyImages = document.querySelectorAll('img.lazy');
            const lazyLoad = function() {
                lazyImages.forEach((img) => {
                    if (img.getBoundingClientRect().top < window.innerHeight && !img.src) {
                        img.src = img.getAttribute('data-src');
                        img.classList.remove('lazy');
                    }
                });
            };
            window.addEventListener('scroll', lazyLoad);
            lazyLoad();
        });
    </script>
@endsection

@endsection
