<?php

namespace App\Livewire\Customer;

use App\Models\Transaction;
use Livewire\Component;

class CustomerTransaction extends Component
{

    public $details;

    public function mount($id)
    {
        $order = Transaction::find($id);
        $this->details = $order->load('purchasedVehicles');;
    }

    public function render()
    {
        return view('livewire.customer.customer-transaction');
    }
}
