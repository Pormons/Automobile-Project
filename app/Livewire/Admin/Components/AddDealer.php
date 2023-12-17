<?php

namespace App\Livewire\Admin\Components;

use App\Livewire\Admin\Vehicle;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;
use RealRashid\SweetAlert\Facades\Alert;

class AddDealer extends ModalComponent
{
    public $input = [];
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
        return view('livewire.admin.components.add-dealer');
    }

    public function createDealer()
    {

        $validated = Validator::make($this->input, [
            "dealer" =>  'required',
            "address" =>  'required',
            "city" => 'required',
            "phone" => 'required',
            "email" =>  'required|unique:App\Models\User,email',
            "password" => 'required',
        ])->validate();

        try {

            $create = User::create([
                "dealer" =>  $validated['dealer'],
                "address" =>  $validated['address'] . ', '. $validated['city'],
                "phone_number" => $validated['phone'],
                "email" =>  $validated['email'],
                "password" => bcrypt( $validated['password']),
                "user_type" => 'dealer',
            ]);

            $create->assignRole('Dealer');
            Alert::toast('User Created Successfully', 'success');
            return redirect()->to('Admin/Dealers');

        } catch (Exception $e) {
            if ($create) {
                $create->delete();
            }
            Alert::toast('Something Went Wrong', 'error');
            return redirect()->to('Admin/Dealers');
        }
    }
}
