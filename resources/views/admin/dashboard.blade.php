<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')
@section('content')

<x-v-nav/>

<div class="page-body-wrapper">

    <x-h-nav/>

    <div class="page-body">

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => Auth::user()->hasRole('super_admin') ? route('admin_dashboard') : (Auth::user()->hasRole('student') ? route('student_dashboard') : (Auth::user()->hasRole('staff') ? route('staff_dashboard') : route('dashboard'))) ],
            ['name' => 'Dashboard'],
            ['name' => Auth::user()->name]
        ]" />


        <!-- Container-fluid starts-->
        <div class="container-fluid default-dashboard">
          <div class="row">
            <div class="col-xl-6 box-col-7 proorder-md-1">
              <div class="card">
                <div class="card-body premium-card">
                  <div class="row premium-courses-card">
                    <div class="col-md-5 premium-course">
                        <h1 class="f-w-700">Access a Website Effortlessly!</h1>
                        <span class="f-light f-w-400 f-14">Dive into a seamless content management experience!</span>
                        <a class="btn btn-square btn-primary f-w-700" href="">Create a Post</a>
                    </div>

                    <div class="col-md-7 premium-course-img">
                      <div class="premium-message"><img class="img-fluid" src="https://admin.pixelstrap.net/zono/assets/images/dashboard/massage.gif" alt="massage"></div>
                      <div class="premium-books"><img class="img-fluid" src="https://admin.pixelstrap.net/zono/assets/images/dashboard/books.gif" alt="books"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

    <x-footer/>

</div>



@endsection
