<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;

class Transactions extends Component
{

    public $details;

    public function mount($id)
    {
        $order = Transaction::find($id);
        $this->details = $order->load('purchasedVehicles');;
    }
    public function render()
    {
        return view('livewire.admin.transactions');
    }
}
