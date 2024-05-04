@extends('layouts.primary')

@section('title')
    Home Page
@endsection

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            Welcome Again!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
