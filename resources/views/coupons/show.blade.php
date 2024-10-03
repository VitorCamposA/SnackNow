@extends('layouts.primary')

@section('content')
    <div class="container">
        <h1 class="mb-4">My Coupons</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-dark table-bordered table-striped">
            <thead>
            <tr>
                <th>Coupon Code</th>
                <th>Restaurant</th>
                <th>Discount Percentage</th>
                <th>Valid Until</th>
            </tr>
            </thead>
            <tbody>
            @forelse($couponsArray as $coupon)
                <tr>
                    <td>{{ $coupon['code'] }}</td>
                    <td>{{ $coupon['name'] }}</td>
                    <td>{{ $coupon['percentage'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon['until'])->format('d/m/y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No coupons found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
