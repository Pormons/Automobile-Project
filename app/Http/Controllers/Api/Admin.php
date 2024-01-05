<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\BodyStyle;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Color;
use App\Models\Dealer;
use App\Models\Manufacturer;
use App\Models\ModelName;
use App\Models\Part;
use App\Models\Partner;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Variant;
use App\Models\Vehicle;
use App\Models\VehiclePart;
use Exception;
use Faker\Core\Uuid;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{

    public function partnerview()
    {

        // $lines = Auth::user()->dealerTransaction()->selectRaw('
        // brand_models.model_name,
        // SUM(transactions.price) AS total_sold')
        // ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        // ->join('vehicles', 'inventories.vin', '=', 'vehicles.vin')
        // ->join('brand_models', 'vehicles.model', '=', 'brand_models.id')
        // ->whereYear('transactions.purchase_date', now()->year)
        // ->where('inventories.sold_status', true)
        // ->groupBy('brand_models.model_name')
        // ->limit(2)
        // ->get();

        $pies = Auth::user()
        ->dealerTransaction()->selectRaw('
        model_name,
        SUM(purchased_vehicles.price) AS sold')
        ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        ->join('inventories','purchased_vehicles.inventory_id','=','inventories.id')
        ->join('vehicles', 'inventories.vin', '=', 'vehicles.vin')
        ->join('brand_models', 'vehicles.model', '=', 'brand_models.id')
        ->whereYear('transactions.purchase_date', now()->year)
        ->where('inventories.sold_status', true)
        ->groupBy('brand_models.model_name')
        ->limit(2)
        ->get();

        $pies = DB::select("
            SELECT
                b.model_name,
                SUM(p.price) AS sold
            FROM purchased_vehicles p
            JOIN transactions t ON t.transaction_id = p.transaction
            JOIN inventories i ON p.inventory_id = i.id
            JOIN vehicles v ON i.vin = v.vin
            JOIN brand_models b ON v.model = b.id
            WHERE i.dealer = :userId
            AND YEAR(t.purchase_date) = :year
            AND i.sold_status = '1'
            GROUP BY b.model_name
            ORDER BY sold DESC
            LIMIT 2"
        ,['userId' => 3, 'year' => 2024]);


        return $pies;
    }

}
