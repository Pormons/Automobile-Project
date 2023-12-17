<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dealer extends Controller
{
    public function viewInventory()
    {
        $user = Auth::user()->inventories()
        ->with('dealer.dealer','vin.model','vin.model.brand', 'vin.model.vehicleParts.part.supplier', 'vin.model.manufacturer', 'vin.model.bodystyle', 'vin.model.color')
        ->get();

        return $user;
    }

    public function viewTransactions()
    {
        $transaction = Auth::user()->trans_dealer;
        return $transaction;
    }

    public function inquireVehicle()
    {

    }
}
