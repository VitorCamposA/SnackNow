<?php

namespace App\Http\Controllers;

use App\Models\SupplierUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthSupplierController extends AuthController
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'dashboard'
        ]);
    }

    public function register()
    {

        return view('auth.supplier_registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        SupplierUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_of' => 1
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashsup')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            $supplier = User::getCurrentUserInstance();

            return view('auth.client_show')->withSuccess('You have logged in successfully!')->with(compact('supplier'));
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }
}
