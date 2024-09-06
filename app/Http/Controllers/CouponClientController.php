<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponClientController extends Controller
{
    public function register($supplierId, Request $request)
    {


        $cupomCliente = DB::table('coupons')->where('supplier_id', decrypt($supplierId))->where('used', false)->get();

        $user = User::where('email', $request->email)->where('type_of', 2)->first();

        if (!$user){

            return redirect()->back()->with('error', 'Cliente não encontrado.');
        }

        foreach ($cupomCliente as $cupom) {
            if ($cupom->valid_from <= now() && $cupom->valid_until >= now()) {
                $this->incrementVisits($cupom->id, $user->id);
            }
        }

        return redirect()->back()->with('success', 'Visita registrada com sucesso.');

    }

    public function useCoupon($supplierId, Request $request)
    {

        $userId = User::where('email', $request->email)->where('type_of', 2)->first()->id;

        if (!$userId) {
            return redirect()->back()->with('error', 'Cliente não encontrado.');
        }

        $couponSupplier = Coupon::where('supplier_id', decrypt($supplierId))->where('code', $request->code)->first();

        $coupon = CouponClient::where('client_id', $userId)->where('coupon_id', $couponSupplier->id)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Cupom não encontrado.');
        }

        if ($coupon->has_permission && !$coupon->was_used) {
            $coupon->was_used = true;
            $coupon->save();

            $couponSupplier->used++;
            $couponSupplier->save();

            return redirect()->back()->with('success', 'Cupom utilizado com sucesso.');
        }

        return redirect()->back()->with('error', 'Cupom não pode ser utilizado.');

    }

    public function incrementVisits(int $couponId, int $clientId): void
    {
        $cupomCliente = CouponClient::where('coupon_id', $couponId)
            ->where('client_id', $clientId)
            ->first();

        if ($cupomCliente) {

            $cupomCliente->visits++;

            $cupom = Coupon::find($couponId);
            if ($cupomCliente->visits >= $cupom->minimum_visits) {
                $cupomCliente->has_permission = true;
            }
            $cupomCliente->save();
        } else {
            // Relacionamento inicial entre cliente e cupom
            DB::table('clients_coupons')->insert([
                'coupon_id' => $couponId,
                'client_id' => $clientId,
                'visits' => 1,
                'has_permission' => false
            ]);

            $cupom = Coupon::find($couponId);

            if (1 >= $cupom->minimum_visits) {
                DB::table('clients_coupons')
                    ->where('coupon_id', $couponId)
                    ->where('client_id', $clientId)
                    ->update(['has_permission' => true]);
            }
        }
    }

}
