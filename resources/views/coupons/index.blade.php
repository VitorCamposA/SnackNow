@extends('layouts.primary')

@section('content')
    <div class="container">
        <h1 class="mb-4">My Coupons</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">Create New Coupon</a>

        <!-- Coupons Table -->
        <table class="table table-dark table-bordered table-striped">
            <thead>
            <tr>
                <th>Coupon Code</th>
                <th>Discount Amount</th>
                <th>Discount Percentage</th>
                <th>Valid From</th>
                <th>Valid Until</th>
                <th>Usage Limit</th>
                <th>Used</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount_amount ? '$' . $coupon->discount_amount : '-' }}</td>
                    <td>{{ $coupon->discount_percentage ? $coupon->discount_percentage . '%' : '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->valid_from)->format('d/m/y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->valid_until)->format('d/m/y') }}</td>
                    <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this coupon?');">Delete</button>
                        </form>
                    </td>
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
