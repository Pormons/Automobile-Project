<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\User;
use Livewire\Component;

class DealerInventory extends Component
{

    public $dealerId;
    public $brands;
    public $searchVin;
    public $searchBrand;
    public $name;

    public function mount($id)
    {
        $this->dealerId = $id;
    }

    public function render()
    {
        $this->brands = Brand::all();
        $dealer = User::find($this->dealerId);
        $this->name = $dealer->dealer;
        $query = $dealer->inventories()->with('vin_info.model_info.brand_info');

        if ($this->searchVin) {
            $query->where('vin', 'LIKE', '%' . $this->searchVin . '%');
        }
        if ($this->searchBrand) {
            $query->whereHas('vin_info.model_info', function ($q) {
                $q->where('brand', $this->searchBrand);
            });
        }


        $inventories = $query->paginate(8);

        return view('livewire.admin.dealer-inventory', compact('inventories'));
    }
}
