<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');  // Ensure signed route for verification link
        $this->middleware('throttle:6,1')->only('verify', 'resend');  // Limit resend attempts
    }

    // Show the email verification notice
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify-email');
    }

    // Handle the email verification process
    public function verify(Request $request)
    {

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }


    // Resend the email verification link
    public function resend(Request $request)
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);  // Confirmation that the email was resent
    }

    // Define where to redirect users after verification
    protected function redirectPath()
    {
        return route('home');  // Redirect to home or any other path you define
    }
}
