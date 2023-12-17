<?php

namespace App\Livewire\Admin\Components;

use App\Models\Partner;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AddPartner extends Component
{
    public $input = [];

    public function render()
    {
        return view('livewire.admin.components.add-partner');
    }

    public function createPartner()
    {
        $validated = Validator::make($this->input, [
            "partner_name" =>  'required',
            "partner_email" =>  'required',
            "partner_phone" => 'required',
            "partner_address" => 'required',
            "partner_type" =>  'required',
        ])->validate();
        try{

            $create = Partner::create($validated);
            Alert::toast('Partner Added','success');
            return redirect()->to('Admin/Partners');
        }catch(Exception $e){
            Alert::toast('Something Went Wrong','error');
        }



    }
}
