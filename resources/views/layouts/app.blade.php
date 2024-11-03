<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>EGS Pillay Dashboard</title>
      <!-- Google font -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      {{-- <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/font-awesome.css") }}"> --}}

      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- ico-font-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/icofont.css") }}">
      <!-- Themify icon-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/themify.css") }}">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/flag-icon.css") }}">
      <!-- Feather icon-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/feather-icon.css") }}">
      <!-- Plugins css start-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/slick.css") }}">
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/slick-theme.css") }}">
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/scrollbar.css") }}">
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/animate.css") }}">
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/datatables.css") }}">

      <!-- Plugins css Ends-->
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/vendors/bootstrap.css") }}">
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}">
      <link id="color" rel="stylesheet" href="{{ asset("assets/css/color-1.css") }}" media="screen">
      <!-- Responsive css-->
      <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/responsive.css") }}">


   </head>
   <body>



    <div class="page-wrapper compact-wrapper" id="pageWrapper">

    @yield('content')


    </div>

@if (session('success'))
    <script>
        swal("Good job!", "{{ session('success') }}", "success");
    </script>
@endif



@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('liveToastsuccess');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>



    <div class="toast-container position-fixed top-0 end-0 p-3">


        <div class="toast show" id="liveToastsuccess" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell toast-icons toast-success"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                <strong class="me-auto">Hey! {{Auth::user()->name}}</strong>

                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body toast-dark">
                {{ session('success') }}
            </div>
          </div>


    </div>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>



    <div class="toast-container position-fixed top-0 end-0 p-3">


        <div class="toast show" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell toast-icons toast-success">
                    <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
                </svg>
                <strong class="me-auto">Hey! {{Auth::user()->name}}</strong>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body toast-dark">
                {{ session('error') }}
            </div>
          </div>


    </div>
@endif


<script>
    $(document).ready(function () {
    // Check for success message
    @if (session('success'))
        $.notify({
            title: 'Success!',
            message: "{{ session('success') }}",
            icon: 'glyphicon glyphicon-ok'
        }, {
            type: 'success',
            delay: 5000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    @endif

    // Check for error message
    @if (session('error'))
        $.notify({
            title: 'Error!',
            message: "{{ session('error') }}",
            icon: 'glyphicon glyphicon-remove'
        }, {
            type: 'danger',
            delay: 5000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    @endif
});

</script>


      <!-- latest jquery-->
      <script src="{{ asset("assets/js/jquery.min.js") }}"></script>

<script src="{{ asset('assets/js/raghavan_jeeva.js') }}"></script>

      <!-- Bootstrap js-->
      <script src="{{ asset("assets/js/bootstrap/bootstrap.bundle.min.js") }}"></script>
      <!-- feather icon js-->
      <script src="{{ asset("assets/js/icons/feather-icon/feather.min.js") }}"></script>
      <script src="{{ asset("assets/js/icons/feather-icon/feather-icon.js") }}"></script>
      <!-- scrollbar js-->
      <script src="{{ asset("assets/js/scrollbar/simplebar.js") }}"></script>
      <script src="{{ asset("assets/js/scrollbar/custom.js") }}"></script>
      <!-- Sidebar jquery-->

      <!-- Plugins JS start-->
      <script src="{{ asset("assets/js/sidebar-menu.js") }}"></script>
      <script src="{{ asset("assets/js/sidebar-pin.js") }}"></script>
      <script src="{{ asset("assets/js/slick/slick.min.js") }}"></script>
      <script src="{{ asset("assets/js/slick/slick.js") }}"></script>
      <script src="{{ asset("assets/js/header-slick.js") }}"></script>


      <link rel="stylesheet" href="{{asset('assets/css/vendors/js-datatables/style.css')}}">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


      <script src="{{ asset("assets/js/datatable/datatables/jquery.dataTables.min.js") }}"></script>

      <script src="{{ asset("assets/js/sweet-alert/sweetalert.min.js") }}"></script>
      <script src="{{ asset("assets/js/height-equal.js") }}"></script>

      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ asset("assets/js/script.js") }}"></script>
      {{-- <script src="{{ asset("assets/js/theme-customizer/customizer.js") }}"></script> --}}

      <script src="{{asset('assets/js/js-datatables/simple-datatables@latest.js')}}"></script>

      <!-- Plugin used-->


   </body>
</html>
