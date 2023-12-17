<?php

namespace App\Livewire\Customer;

use App\Models\Inventory;
use App\Services\CartService;
use Exception;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleDetails extends Component
{

    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $vehicle = Inventory::with('vin_info.vehicleparts')->findorfail($this->id);

        return view('livewire.customer.vehicle-details',compact('vehicle'));
    }

    public function addCart(CartService $cartService){

        try{
            $cartService->addToCart($this->id);
            Alert::toast('Added to Cart', 'success');
            $this->dispatch('update-cart');
        }catch(Exception $e)
        {
            Alert::toast('Something went Wrong', 'error');
        }
    }

    public function removeCart(CartService $cartService)
    {
        $cartService->removeFromCart($this->id);
        $this->dispatch('update-cart');
    }
}
