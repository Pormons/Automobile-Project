<?php

namespace App\Livewire\Dealer\Components;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\User;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AddInventory extends Component
{

    public $selectedVin;

    public $searchVin;
    public $searchBrand;
    public $searchModel;
    public $selectedVehicle;
    public $selectedVins = [];

    public $id;

    public function mount()
    {
        $this->id = Auth::user()->id;
    }

    public function selectVin($vin)
    {
        $this->selectedVin = $vin;
        $this->selectedVehicle = Vehicle::doesntHave('inventories')->where('vin', $vin)->first();
    }

    public function render()
    {

        $query = Vehicle::doesntHave('inventories')
            ->with('model_info.brand_info');

        if ($this->searchVin) {
            $query->where('vin', 'LIKE', '%' . $this->searchVin . '%');
        }

        if ($this->searchBrand) {
            $query->whereHas('model_info.brand_info', function ($q) {
                $q->where('brand', $this->searchBrand);
            });
        }

        if ($this->searchModel) {
            $query->where('model', $this->searchModel);
        }

        $brands = Brand::all();

        // Filter brand models based on the searchBrand
        $brandmodels = BrandModel::when($this->searchBrand, function ($query) {
            $query->where('brand', $this->searchBrand );
        })->get();

        $vins = $query->get();
        return view('livewire.dealer.components.add-inventory', compact('vins', 'brands', 'brandmodels'));
    }

    public function addVehicles()
    {
        try{
            $dealer = User::findOrFail(Auth::user()->id);
            $vehicles = $this->selectedVins;
            foreach ($vehicles as $key => $data) {
                $dealer->inventories()->create(['vin' => $data]);
            }

            Alert::toast('Successfully Added to Inventory', 'success');
            return redirect()->to('/Dealer/Inventory');
        }catch(Exception $e){
            Alert::toast('Something Went Wrong!', 'error');
        }
    }
}
