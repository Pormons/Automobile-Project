<?php

namespace App\Livewire\Dealer;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Inventory as ModelsInventory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{

    use WithPagination;
    public $name;

    public $retail;

    public $searchVin, $searchModel, $searchBrand, $searchStatus, $status;
    public $dealerId;

    public function render()
    {
        Auth::user()->id;

        $dealer = User::find(Auth::user()->id);
        $this->dealerId = $dealer->id;
        $this->name = $dealer->dealer;

        $query = $dealer->inventories()->with('vin_info.model_info.brand_info');

        if ($this->searchVin) {
            $query->where('vin', 'LIKE', '%' . $this->searchVin . '%');
        }

        if ($this->searchStatus) {
            $query->where('available', $this->searchStatus);
        }

        if ($this->status) {
            $query->where('sold_status', $this->status);
        }

        if ($this->searchBrand) {
            $query->whereHas('vin_info.model_info', function ($q) {
                $q->where('brand', $this->searchBrand);
            });
        }

        if ($this->searchModel) {
            $query->whereHas('vin_info', function ($q) {
                $q->where('model', $this->searchModel);
            });
        }

        $inventories = $query->paginate(8);

        $brands = Brand::all();

        $brandmodels = BrandModel::when($this->searchBrand, function ($query) {
            $query->where('brand', $this->searchBrand);
        })->get();

        return view('livewire.dealer.inventory', compact('inventories','brands','brandmodels'));
    }

    public function toggleUserStatus($vin)
    {
        $dealer = User::find(Auth::user()->id);
        $stock = $dealer->inventories()->where('vin', $vin)->first();
        $stock->update(['available' => !$stock->available]);
    }

    public function returnVehicle($id)
    {
        $vehicle = ModelsInventory::findorfail($id);
        $vehicle->delete();
    }

    public function soldVehicle($id)
    {
        $vehicle = ModelsInventory::findorfail($id);
        $vehicle->update(['sold_status' => !$vehicle->sold_status]);;
    }

    public function retailPrice($id)
    {
        $this->dispatch('update-retail', id:$id);
    }
}
