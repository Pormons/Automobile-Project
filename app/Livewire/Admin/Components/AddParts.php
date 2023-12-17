<?php

namespace App\Livewire\Admin\Components;

use App\Models\Partner;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AddParts extends Component
{
    public $id;
    public $input = [];
    public function mount($partnerId)
    {
        $this->id = $partnerId;
    }

    public function render()
    {
        return view('livewire.admin.components.add-parts');
    }

    public function createPart()
    {
        try{
            $validated = Validator::make($this->input, [
                "part_name" =>  'required',
                "part_type" =>  'required',
                "manufactured_date" => 'required|date',
            ])->validate();

            $supplier = Partner::findorfail($this->id);
            $supplier->parts()->create($validated);

            Alert::toast('Successfully Created', 'success');
            return redirect()->to('Admin/Partners/'.$supplier->id."/Inventory");

        }catch(Exception $e){
            Alert::toast('Something Went Wrong!', 'error');
        }

    }


}
