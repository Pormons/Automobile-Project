<?php

namespace App\Livewire\Admin\Components;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Partner;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class AddModel extends Component
{

    use WithFileUploads;
    public $manufacturers;
    public $brands;

    #[Rule('nullable|image')]
    public $photo;
    public $input = [];

    public function render()
    {
        $this->brands = Brand::all();
        $this->manufacturers = Partner::where('partner_type','Manufacturer')->get();
        return view('livewire.admin.components.add-model');
    }

    public function createModel()
    {
        try
        {
            $validated = Validator::make($this->input, [
                "model_name" =>  'required',
                "brand" =>  'required',
                "manufacturer" => 'required',
            ])->validate();

            if($this->photo)
            {
                $validated['image_url'] = $this->photo->store('uploads','public');
            }

            BrandModel::create($validated);
            Alert::toast('Model Created', 'success');
            return redirect()->to('Admin/Vehicles');

        }catch(Exception $e)
        {
            Alert::toast('Something Went Wrong!', 'error');
        }

    }
}
