@extends('layouts.primary')

@section('content')
    <div class="container text-white">
        <h1>Create Coupon</h1>
        <form method="POST" action="{{ route('coupons.store') }}">
            @csrf
            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="discount_amount">Discount Amount</label>
                <input type="number" name="discount_amount" class="form-control bg-dark text-light">
            </div>
            <div class="form-group">
                <label for="discount_percentage">Discount Percentage</label>
                <input type="number" name="discount_percentage" class="form-control bg-dark text-light">
            </div>
            <div class="form-group">
                <label for="valid_from">Valid From</label>
                <input type="date" name="valid_from" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="valid_until">Valid Until</label>
                <input type="date" name="valid_until" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" name="usage_limit" class="form-control bg-dark text-light">
            </div>
            <button type="submit" class="btn btn-primary">Create Coupon</button>
        </form>
    </div>
@endsection
