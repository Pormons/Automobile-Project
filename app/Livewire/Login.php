<?php

namespace App\Livewire;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Login extends Component
{

    public $login = [];
    public function render()
    {
        return view('livewire.login');
    }


    public function signIn()
    {
        $validated = Validator::make($this->login, [
            "email" =>  'required|email',
            "password" =>  'required',
        ])->validate();

        try{

            if (Auth::attempt($validated)) {
                session()->regenerate();

                if (Auth::user()->hasRole('Customer') && Auth::user()->user_type == 'customer') {
                    Alert::toast('Logged In Successfuly', 'success');
                    return redirect()->to('/');
                }

                if (Auth::user()->hasRole('Dealer') && Auth::user()->user_type == 'dealer') {
                    Alert::toast('Logged In Successfuly', 'success');
                    return redirect()->intended('/Dealer/Home');

                }

                if (Auth::user()->hasRole('Admin') && Auth::user()->user_type == 'admin') {
                    Alert::toast('Logged In Successfuly', 'success');
                    return redirect()->intended('/Admin/Vehicles');
                }
            }

            Alert::toast('Wrong Credentials', 'error');
            return redirect()->back()->with('error', 'Please check your credentials');

        }catch (Exception $e) {
            Alert::toast('Something Went Wrong!', 'error');
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
