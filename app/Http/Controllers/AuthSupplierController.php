<?php

namespace App\Http\Controllers;

use App\Models\SupplierUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthSupplierController extends AuthController
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'dashboard', 'updateSchedule', 'uploadImage', 'edit', 'update'
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
            'password' => 'required|min:8|confirmed',
            'address' => 'required|min:8',
            'phone' => 'required|min:8',
            'specialty' => 'required|max:20',
            'cep' => 'required|min:8',
            'number' => 'required|min:1',
        ]);

        $user = SupplierUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_of' => 1,
            'address' => $request->address,
            'phone' => $request->phone,
            'specialty' => $request->specialty,
            'cep' => $request->cep,
            'address_complement' => $request->complement ?? null,
            'address_number' => $request->number,
        ]);

        event(new Registered($user));

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

    public function updateSchedule(Request $request, $supplierId)
    {
        $supplier = User::findOrFail($supplierId);

        // Store new schedules
        foreach ($request->input('schedule') as $day => $time) {
            $openClose = explode(' - ', $time);
            $schedule = $supplier->schedules()->where('day', $day)->first();

            if (count($openClose) == 2) {
                if ($schedule) {
                    // Update existing schedule
                    $schedule->update([
                        'open_time' => $openClose[0],
                        'close_time' => $openClose[1],
                    ]);
                } else {
                    // Create new schedule
                    $supplier->schedules()->create([
                        'day' => $day,
                        'open_time' => $openClose[0],
                        'close_time' => $openClose[1],
                    ]);
                }
            } elseif ($schedule) {
                // Delete existing schedule if no value provided
                $schedule->delete();
            }
        }

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $imagePath = $request->file('image')->store('profile_images', 'public');

        $user->profile_image = $imagePath;
        $user->save();

        return back()->with('success', 'Imagem de perfil atualizada com sucesso!');
    }

    public function edit()
    {

        $user = Auth::user();

        return view('auth.edit_supplier')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . decrypt($id),
            'phone' => 'required|string|max:15',
            'cep' => 'required|string|max:9',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'specialty' => 'nullable|string',
        ]);

        $user = User::findOrFail(decrypt($id));

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->specialty = $request->input('specialty');
        $user->cep = $request->input('cep');
        $user->address_complement = $request->input('complement');
        $user->address_number = $request->input('number');

        $user->save();

        return redirect()->route('dashsup')->with('success', 'Informações atualizadas com sucesso!');
    }
}
