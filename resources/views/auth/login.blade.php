
@extends('layouts.app')
@section('content')

<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div>
                        <a class="logo" href="{{ url('/') }}">
                            <img class="img-fluid for-light" src="{{asset('assets/images/egspec.png')}}" alt="Logo">
                            <img class="img-fluid for-dark" src="{{asset('assets/images/w_egspec.png')}}" alt="Logo">
                        </a>
                    </div>
                    <div class="login-main">
                        <h1>Login</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="*********" required>
                            </div>
                            <div class="form-group mb-0 mt-3">

                                <a class="link mt-1" href="{{ route('password.request') }}">Forgot password?</a>
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                </div>
                            </div>
                        </form>

                        <div class="social mt-4">
                            <div class="btn-showcase">
                                <!-- Display error message here -->
                                @if ($errors->any())
                                    <h6 class="text-danger mt-4">{{ $errors->first() }}</h6>
                                @elseif (session('error'))
                                    <h6 class="text-danger mt-4">{{ session('error') }}</h6>

                                @endif
                            </div>
                        </div>
                        <p class="mt-4 mb-0 text-center">Don't have an account? <a class="ms-2" href="{{ route('register') }}">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

