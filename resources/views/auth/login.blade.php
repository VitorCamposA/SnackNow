@extends('layouts.primary')

@section('title')
    Login
@endsection

@section('content')
    <div class="row justify-content-center mt-5" style="min-height: 79vh;">
        <div class="col-md-8">

            <div class="card text-white" style="background-color: #343A40">
            <h3 class="card-header text-center">Login</h3>
                <div class="card-body">
                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <div class="mb-3 row d-flex justify-content-center">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror w-50" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row d-flex justify-content-center">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror w-50" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <p class="text-center">
                            Forgot your password?
                            <a href="{{route('password.request')}}">Click here to reset it</a>.
                        </p>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
