@extends('layouts.app')

@section('content')
<div class="error-wrapper">
    <div class="container">
        <div class="col-md-8 offset-md-2">
            @if (Route::has('login'))
                @auth
                    <h3>Welcome, {{ Auth::user()->name }}! Continue to your Dashboard.</h3>

                    @if (Auth::user()->hasRole('super_admin'))
                        <a href="{{ route('admin_dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
                    @elseif (Auth::user()->hasRole('student'))
                        <a href="{{ route('student_dashboard') }}" class="btn btn-primary">Student Dashboard</a>
                    @elseif (Auth::user()->hasRole('staff'))
                        <a href="{{ route('staff_dashboard') }}" class="btn btn-primary">Staff Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @endif
                @else
                    <h3>Welcome to EGSPEC CMS! Please login or register to continue to your Dashboard.</h3>
                    {{-- <p class="sub-content">Choose an option:</p> --}}
                    <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</div>
@endsection
