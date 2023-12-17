<?php

namespace App\Livewire\Customer;

use App\Models\Inventory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Checkout extends Component
{
    public $inventory;
    public $user;
    public function mount($id)
    {
        $this->inventory = Inventory::findorfail($id);
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.customer.checkout');
    }

    public function confirmOrder()
    {
        try{
            $customerTransaction = Auth::user()->customerTransaction()->create([
                'dealer' => $this->inventory->dealer_info->id,
                'purchase_date' => now(),
                'status' => 'Pending'
            ]);

            $vehicles =  $customerTransaction->purchasedVehicles()->create([
                'inventory_id' => $this->inventory->id,
                'price' => $this->inventory->retail_price
            ]);

            $this->inventory->available = false;
            $this->inventory->save();

            Alert::toast('Successfully placed an order!', 'success');
            return redirect()->to('/Customer/Transactions');
        }catch(Exception $e)
        {
            Alert::toast('Something Went Wrong!', 'error');
        }

    }
}
