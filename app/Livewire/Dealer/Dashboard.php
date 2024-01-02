<?php

namespace App\Livewire\Dealer;

use App\Models\PurchasedVehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{

    public $annual,$month,$inventory,$sold,$available,$orders,$sold_status,$rejected,$pending;
    public $year,$months;

    public function render()
    {
        $currentYear = $this->year;
        $currentMonth = now()->month;

        $this->annual = Auth::user()->dealerTransaction()
        ->whereYear('purchase_date', $currentYear)
        ->where('status', 'sold')
        ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        ->sum('purchased_vehicles.price');

        $this->month = Auth::user()->dealerTransaction()
        ->whereMonth('purchase_date', $currentMonth)
        ->where('status', 'sold')
        ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        ->sum('purchased_vehicles.price');

        $this->inventory = Auth::user()->inventories->count();
        $this->sold = Auth::user()->inventories->where('sold_status', true)->count();
        $this->available = Auth::user()->inventories->where('available', true)->count();

        $this->orders = Auth::user()->dealerTransaction->count();
        $this->sold_status = Auth::user()->dealerTransaction->where('status', 'sold')->count();
        $this->rejected = Auth::user()->dealerTransaction->where('status', 'Rejected')->count();
        $this->pending = Auth::user()->dealerTransaction->where('status', 'Pending')->count();
        return view('livewire.dealer.dashboard');
    }
}
