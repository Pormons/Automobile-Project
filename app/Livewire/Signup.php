<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Signup extends Component
{
    public $register = [];

    public $cities = [];


    public function mount()
    {
        $this->cities = Cache::remember('cities', 3600, function () {
            // Fetch cities from storage if not found in cache
            $contents = File::get(base_path('cities.json'));
            $data = json_decode($contents);
            return $data;
        });
    }

    public function render()
    {
        return view('livewire.signup');
    }

    public function createAccount()
    {
        $validated = Validator::make($this->register, [
            "first_name" =>  'required',
            "middle_name" =>  'required',
            "last_name" => 'required',
            "city" => 'required',
            "address" => 'required',
            "phone" => 'required',
            "email" =>  'required|unique:App\Models\User,email',
            "password" => 'required',
        ])->validate();

        try {

            $create = User::create([
                "first_name" =>  $validated['first_name'],
                "middle_name" =>  $validated['middle_name'],
                "last_name" =>  $validated['last_name'],
                "address" =>  $validated['address'] . ', '. $validated['city'],
                "phone_number" => $validated['phone'],
                "email" =>  $validated['email'],
                "password" => bcrypt( $validated['password']),
            ]);

            $create->assignRole('Customer');

            session()->flash('success', 'User Created');
            return redirect()->to('/Login');

        } catch (Exception $e) {
            if ($create) {
                $create->delete();
            }
            session()->flash('error', 'Something Went Wrong');
            return back()->withErrors($e->errors())->withInput();
        }
    }
}

