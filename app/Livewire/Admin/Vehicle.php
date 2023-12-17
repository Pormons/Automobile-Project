<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Vehicle as ModelsVehicle;
use Livewire\Component;

class Vehicle extends Component
{
    public $search;

    public $brandSearch;

    public function render()
    {
        $brands = Brand::all();
        $query = ModelsVehicle::query();

        if($this->search){
            $query->where('vin', 'LIKE', '%' . $this->search . '%');
        }
        if($this->brandSearch)
        {
            $query->whereHas('model_info.brand_info', function ($q) {
                $q->where('brand', $this->brandSearch);
            });

        }

        $vehicles = $query->paginate(8);

        return view('livewire.admin.vehicle', compact('vehicles','brands'));
    }

    public function deleteVin($vin)
    {
        $vehicle = ModelsVehicle::where('vin', $vin)->first();
        $vehicle->delete();
        return redirect()->to('Admin/Vehicles');
    }
}
