<?php

namespace App\Livewire\Admin\Components;

use App\Models\User;
use App\Models\Vehicle;
use Exception;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AddVehicleDealer extends Component
{

    public $selectedVin;

    public $searchVin;

    public $selectedVehicle;
    public $selectedVins = [];

    public $id;

    public function mount($dealerId)
    {
        $this->id = $dealerId;
    }

    public function selectVin($vin)
    {
        $this->selectedVin = $vin;
        $this->selectedVehicle = Vehicle::doesntHave('inventories')->where('vin', $vin)->first();
    }

    public function render()
    {

        $query = Vehicle::doesntHave('inventories');
        if($this->searchVin)
        {
            $query->where('vin', 'LIKE', '%' . $this->searchVin . '%');
        }

        $vins = $query->get();
        return view('livewire.admin.components.add-vehicle-dealer', compact('vins'));
    }

    public function addVehicles($id)
    {

        try{
            $dealer = User::findOrFail($id);

            $vehicles = $this->selectedVins;

            foreach ($vehicles as $key => $data) {
                $dealer->inventories()->create(['vin' => $data]);
            }

            Alert::toast('Successfully Added Vehicle', 'success');
            return redirect()->to('Admin/Dealer/'.$id.'/Inventory');
        }catch(Exception $e)
        {
            Alert::toast('Something went Wrong!', 'error');
        }

    }
}
