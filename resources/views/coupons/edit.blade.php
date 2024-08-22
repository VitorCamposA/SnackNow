@extends('layouts.primary')

@section('content')
    <div class="container">
        <h1>Edit Coupon</h1>
        <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" class="form-control bg-dark text-light" value="{{ $coupon->code }}" required>
            </div>

            <div class="form-group">
                <label for="discount_amount">Discount Amount</label>
                <input type="number" name="discount_amount" class="form-control bg-dark text-light" value="{{ $coupon->discount_amount }}">
            </div>

            <div class="form-group">
                <label for="discount_percentage">Discount Percentage</label>
                <input type="number" name="discount_percentage" class="form-control bg-dark text-light" value="{{ $coupon->discount_percentage }}">
            </div>

            <div class="form-group">
                <label for="valid_from">Valid From</label>
                <input type="date" name="valid_from" class="form-control bg-dark text-light" value="{{ $coupon->valid_from }}" required>
            </div>

            <div class="form-group">
                <label for="valid_until">Valid Until</label>
                <input type="date" name="valid_until" class="form-control bg-dark text-light" value="{{ $coupon->valid_until }}" required>
            </div>

            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" name="usage_limit" class="form-control bg-dark text-light" value="{{ $coupon->usage_limit }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Coupon</button>
        </form>
    </div>
@endsection
