
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Two Factor Authentication</div>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <div class="card-body">
                    <form method="POST" action="/two-factor-challenge">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <div class="form-group">
                            <label for="code">Enter your authentication code</label>
                            <input type="text" name="code" id="code" class="form-control" required autofocus>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                Authenticate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
