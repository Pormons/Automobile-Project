<?php

namespace App\Livewire\Customer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    public $searchTransaction;

    public $start,$end;

    public function render()
    {
        $query = Auth::user()->customerTransaction()
        ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        ->select('transactions.*', DB::raw('SUM(purchased_vehicles.price) as total, COUNT(purchased_vehicles.inventory_id) as quantity'))
        ->groupBy('transactions.transaction_id');

        if($this->searchTransaction)
        {
            $query->where('transaction_id','LIKE','%'.$this->searchTransaction.'%');
        }

        if ($this->start || $this->end) {
            $startDate = $this->start ? $this->start  : now()->startOfDay()->timestamp;
            $endDate = $this->end ? $this->end : now()->endOfDay()->timestamp;

            $query->whereDate('purchase_date', '<=', $startDate)
                  ->whereDate('purchase_date', '>=', $endDate);
        }

        $transactions = $query->paginate(8);

        return view('livewire.customer.transactions',compact('transactions'));
    }
}
