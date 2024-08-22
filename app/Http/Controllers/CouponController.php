<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        // Display all coupons for the authenticated supplier
        $coupons = Coupon::where('supplier_id', Auth::id())->get();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount_amount' => 'required_without:discount_percentage|numeric',
            'discount_percentage' => 'required_without:discount_amount|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer',
        ]);

        Coupon::create([
            'code' => $request->code,
            'discount_amount' => $request->discount_amount,
            'discount_percentage' => $request->discount_percentage,
            'valid_from' => $request->valid_from,
            'valid_until' => $request->valid_until,
            'usage_limit' => $request->usage_limit,
            'supplier_id' => Auth::id(),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully!');
    }

    public function edit(Coupon $coupon)
    {
        // Ensure the coupon belongs to the authenticated supplier
        $this->authorize('update', $coupon);

        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $this->authorize('update', $coupon);

        $request->validate([
            'discount_amount' => 'required_without:discount_percentage|numeric',
            'discount_percentage' => 'required_without:discount_amount|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $this->authorize('delete', $coupon);

        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}

