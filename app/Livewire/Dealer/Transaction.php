<?php

namespace App\Livewire\Dealer;

use App\Models\Inventory;
use App\Models\Transaction as ModelsTransaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Transaction extends Component
{
    use WithPagination;

    public $searchTransaction, $status;
    public function render()
    {
            $query = Auth::user()->dealerTransaction()
            ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
            ->select('transactions.*', DB::raw('SUM(purchased_vehicles.price) as total, COUNT(purchased_vehicles.inventory_id) as quantity'))
            ->groupBy('transactions.transaction_id');

            if($this->searchTransaction)
            {
                $query->where('transaction_id','LIKE','%'.$this->searchTransaction.'%');
            }
            if($this->status)
            {
                $query->where('status', $this->status);
            }

            $transactions = $query->paginate(8);

        return view('livewire.dealer.transaction', compact('transactions'));
    }

    public function confirmSold($transactionId)
    {
        try{
            $transaction = Auth::user()->dealerTransaction()->findOrFail($transactionId);
            $transaction->status = 'sold';
            $transaction->purchase_date = now();
            $transaction->save();

            foreach ($transaction->purchasedVehicles as $vehicle) {
                // Update inventory status
                $vehicle->dealer_inventory->sold_status = true;
                $vehicle->dealer_inventory->save();

                // Update vehicle status
                $vehicle =  $vehicle->dealer_inventory->vin_info;
                $vehicle->status = 'sold';
                $vehicle->save();
            }

            Alert::toast('Transaction Sold', 'success');
        }catch(Exception $e)
        {
            Alert::toast('Something Went Wrong', 'error');
        }

    }

    public function rejected($transactionId)
    {
        $transaction = ModelsTransaction::findorfail($transactionId);
        $transaction->status = 'Rejected';
        $transaction->save();

        foreach ($transaction->dealerInventories as $inventory) {

            $inventory->sold_status = false;
            $inventory->available = true;
            $inventory->save();

            $vehicle = $inventory->vin_info;
            $vehicle->status = '';
            $vehicle->save();
        }
    }
}
