<?php

namespace App\Livewire\Dealer;

use App\Models\Transaction;
use Livewire\Component;

class TransactionDetails extends Component
{

    public $details;

    public function mount($id)
    {
        $order = Transaction::find($id);
        $this->details = $order->load('purchasedVehicles');;
    }

    public function render()
    {
        return view('livewire.dealer.transaction-details');
    }
}
