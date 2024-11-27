<?php

namespace App\Http\Controllers;

use App\Models\ClientUser;
use App\Models\SupplierUser;
use App\Models\User;
use App\Notifications\SimpleNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends AuthController
{


    public function __construct()
    {
        $this->middleware('guest')->except([
            'dashboard', 'show'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.client_registration');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = ClientUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_of' => 2
        ]);

        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashcli')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            Auth()->user()->notify(new SimpleNotification('OLA'));

            $user = Auth::user();

            $query = User::where('type_of', 1)
            ->with('favorites')
            ->selectRaw('users.*, IF(favorites.user_id IS NOT NULL, 1, 0) as is_favorite')
                ->leftJoin('favorites', function ($join) use ($user) {
                    $join->on('users.id', '=', 'favorites.favorite_user_id')
                    ->where('favorites.user_id', '=', $user->id);
                });

            if ($request->has('specialty') && $request->specialty != '') {
                $query->where('specialty', $request->specialty);
            }

            $suppliers = $query->orderByDesc('is_favorite')
                ->orderBy('name')
                ->get();

            return view('auth.home', compact('suppliers'))
                ->withSuccess('You have logged in successfully!');
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }


    public function show($id){

        $id = decrypt($id);

        $supplier = SupplierUser::where('id', $id)->first();

        return view('auth.client_show')->with(compact('supplier'));
    }
}
