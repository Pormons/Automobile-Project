<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{

    public function loginPage()
    {
        return view('authentication.login');
    }
    public function signupPage()
    {
        return view('authentication.signup');
    }

    public function login(AuthenticationRequest $request){

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->hasRole('Customer') && Auth::user()->user_type === 'customer')
            {
                return redirect()->intended('home');
            }

            if(Auth::user()->hasRole('Dealer') && Auth::user()->user_type === 'dealer')
            {
                return redirect()->intended('dealerDashboard');
            }

            if(Auth::user()->hasRole('Admin') && Auth::user()->user_type === 'admin')
            {
                return redirect()->intended('adminDashboard');
            }
        }

        return back()->withErrors([
            'credentials' => __('auth.failed'),
        ]);

    }

    public function register(AuthenticationRequest $request){

        $validated = $request->safe()->except(['user-type']);

        $user = User::create($validated);

        switch ($request['user-type']) {

            case 'individual':
                $user->assignRole('Customer');
                break;

            case 'company':
                $user->assignRole('Customer');
                break;
        }

        return $user->getRoleNames();

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('login');

    }
}
