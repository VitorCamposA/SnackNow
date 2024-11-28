<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::where('supplier_id', Auth::id())->get();
        return view('coupons.index', compact('coupons'));
    }

    public function show()
    {

        $coupons = CouponClient::where('client_id', Auth::id())->get();

        $couponsArray = [];
        foreach ($coupons as $key =>$coupon) {
            $couponSupplier = Coupon::where('id', $coupon->coupon_id)->first();
            $supplier = User::where('id', $couponSupplier->supplier_id)->first();

            $missingVisits = $couponSupplier->minimum_visits - $coupon->visits;

            if (!$couponSupplier->was_used
                && $couponSupplier->valid_from <= now()
                && $couponSupplier->valid_until >= now()){
                $couponsArray[$key]['code'] = $couponSupplier->code;
                $couponsArray[$key]['discount_amount'] = $couponSupplier->discount_amount;
                $couponsArray[$key]['name'] = $supplier->name;
                $couponsArray[$key]['percentage'] = $couponSupplier->discount_percentage . '%';
                $couponsArray[$key]['from'] = $couponSupplier->valid_from;
                $couponsArray[$key]['until'] = $couponSupplier->valid_until;
                $couponsArray[$key]['has_permission'] = $couponSupplier->$missingVisits;
            }
        }

        return view('coupons.show', compact('couponsArray'));
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'discount_amount' => 'nullable|numeric',
            'discount_percentage' => 'nullable|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date',
            'minimum_visits' => 'nullable|integer|min:0',
        ]);

        Coupon::create([
            'code' => $request->code,
            'discount_amount' => $request->discount_amount,
            'discount_percentage' => $request->discount_percentage,
            'valid_from' => $request->valid_from,
            'valid_until' => $request->valid_until,
            'minimum_visits' => $request->minimum_visits,
            'supplier_id' => Auth::id(),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
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

        $request->merge([
            'discount_amount' => $request->discount_amount ?? 0,
            'discount_percentage' => $request->discount_percentage ?? 0,
        ]);

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
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}

