<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CartPage extends Component
{
    public $vehicles;


    #[On('update-cart')]
    public function mount()
    {
        $inventory = array_keys(session('shoppingCart', []));
        $this->vehicles = Inventory::whereIn('id',$inventory)->get();

    }

    public function render()
    {
        return view('livewire.cart-page');
    }

    public function removeCart(CartService $cartService, $id)
    {
        $cartService->removeFromCart($id);
        $this->dispatch('update-cart');
    }

    public function confirmOrder()
    {

    $selectedInventories = $this->vehicles;

    if($this->vehicles->isEmpty())
    {
        Alert::toast('Empty Cart', 'error');
        return redirect()->to('/Cart');
    }

    $customer = Auth::user();
    $inventoriesByDealer = collect($selectedInventories)->groupBy('dealer_info.id');

    foreach ($inventoriesByDealer as $dealerId => $inventories) {
        $transaction = $customer->customerTransaction()->create([
            'dealer' => $dealerId,
            'status' => 'Pending',
            'purchase_date' => now(),
        ]);

        foreach ($inventories as $inventory) {
            $transaction->purchasedVehicles()->create([
                'inventory_id' => $inventory->id,
                'price' => $inventory->retail_price,
            ]);

            $inventory->available = false;
            $inventory->save();
        }
    }

    Session::forget('shoppingCart');
    return redirect()->to('/Customer/Transactions');
    }

}
