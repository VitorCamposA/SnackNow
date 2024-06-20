<?php

namespace App\Http\Controllers;

use App\Models\ClientUser;
use App\Models\SupplierUser;
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

        ClientUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_of' => 2
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashcli')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            return view('auth.home')->withSuccess('You have logged in successfully!');
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }

    public function show($id){

        $supplier = SupplierUser::where('id', $id)->first();

        return view('auth.client_show')->with(compact('supplier'));
    }
}
