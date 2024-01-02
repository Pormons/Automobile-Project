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
        $partner = Partner::find(3);
        $vehicles = $partner->brandmodels()->with('vehicles')->paginate(7);
        return $vehicles;
    }

    public function storeManufacturer(Request $request)
    {
        $manufacturer = Manufacturer::create([
            "manufacturer" => $request->manufacturer,
            "manufacturer_address" => $request->manufacturer_address,
        ]);
        return $manufacturer;
    }


    public function viewTransactions()
    {
        // $user = User::findOrFail(2);
        // $transactions = $user->dealerTransaction()
        // ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
        // ->select('transactions.*', DB::raw('SUM(purchased_vehicles.price) as total, COUNT(purchased_vehicles.inventory_id) as quantity'))
        // ->groupBy('transactions.transaction_id')
        // ->get();

            $transaction = Transaction::find('17D2A-21517024');
            $details = $transaction->load('purchasedVehicles');

        return $details;

    }

    public function purchaseVehicle(Request $request)
    {

        $user = User::findorfail(3);
        $dealerId = 2;

        // Create customer transaction
        $customerTransaction = $user->customerTransaction()->create([
            'dealer' => $dealerId,
            'purchase_date' => now()
        ]);

        $vehicles = json_decode($request->vin);

        foreach ($vehicles as $data) {
            $customerTransaction->purchasedVehicles()->create([
                'inventory_id' => $data->vin
            ]);
        }

        return response()->json($user->customerTransaction,200);

    }

    public function storeSupplier(Request $request)
    {
        $supplier = Supplier::create([
            "supplier" => $request->supplier,
            "supplier_address" => $request->supplier_address,
            "supplier_email" => $request->supplier_email,
        ]);
        return $supplier;
    }

    public function viewSupplier()
    {
        $supplier = Supplier::all();
        return $supplier;
    }

    public function storeDealers(Request $request)
    {
        $dealers = User::create([
            "first_name" => $request->dealer,
            "address" => 'capitol',
            "phone_number" => $request->phone_number,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "user_type" => 'individual',
        ]);
        $dealers->assignRole('Individual');
        return $dealers->dealer;
    }

    public function viewDealers(Request $request)
    {
        $dealers = User::whereHas('dealer_infos', fn ($query) => $query->where('dealer', 'LIKE', '%' . $request->searchDealer . '%'))
        ->get();
        return $dealers->load('dealer');
    }

    public function deleteDealer($id)
    {
        try{
            $dealers = User::findorfail($id)->delete();

            return response()->json(['Successfully deleted'], 200);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function storeBodyStyles(Request $request)
    {
        $bodyStyles = BodyStyle::create([
            'body_style' => $request->body_style,
        ]);
        return $bodyStyles;
    }

    public function viewBodyStyles()
    {
        $bodyStyles = BodyStyle::all();
        return $bodyStyles;
    }

    public function storeColors(Request $request)
    {
        $colors = Color::create([
            'color_name' => $request->color,
        ]);
        return $colors;
    }

    public function viewColors()
    {
        $colors = Color::all();
        return $colors;
    }


    public function storeParts(Request $request)
    {
        $parts = Part::create([
            'part_name' => $request->part_name,
            'part_type' => $request->part_type,
            'supplier' => $request->supplier,
            'manufacturing_date' => $request->manufacturing_date
        ]);

        return $parts->load('supplier');
    }

    public function viewParts()
    {
        $parts = Part::with('supplier')->get();
        return $parts;
    }

    public function storeVariants(Request $request)
    {
        $variant = Variant::create([
            'variant_name' => $request->variant,
        ]);

        return $variant;
    }

    public function viewVariants()
    {
        $variant = Variant::all();
        return $variant;
    }

    public function storeBrands(Request $request)
    {
        $brands = Brand::create([
            'brand_name' => $request->brand_name,
        ]);

        return $brands;
    }

    public function viewBrands()
    {
        $brands = Brand::all();
        return $brands;
    }

    public function storeBrandModels(Request $request)
    {
        $brandmodel = BrandModel::create([
            "model_name" => $request->model_name,
            "brand" => $request->brand,
            "manufacturer" => $request->manufacturer
        ]);

        return $brandmodel->load('brand','manufacturer');
    }

    public function viewBrandModels()
    {
        $brandmodel = BrandModel::with('brand','manufacturer')
        ->get();
        return $brandmodel;
    }

    public function storeVehicles(Request $request)
    {
        $vehicle = Vehicle::create([
            "model" => $request->model,
            "variant" => $request->variant,
            "color" => $request->color,
            "body" => $request->body,
            "model_year" => $request->model_year,
            "price" => $request->price,
        ]);

        $data = [
            ["part" => $request->axle],
            ["part" => $request->transmission],
            ["part" => $request->engine],
        ];

        $vehicle->vehicleparts()->createMany($data);

        return $vehicle->load('model','variant','color','body','vehicleparts');
    }

    public function viewVehicles()
    {
        $vehicle = Vehicle::with('model','variant','color','body')->get();

        $result = $vehicle->groupBy('model');

        return $result;
    }

    public function storeDealerInventory(Request $request)
    {

        $dealer = User::findOrFail($request->dealer);

        $vehicles = json_decode($request->vehicles);

        foreach ($vehicles as $data) {
            $dealer->inventories()->create(['vin' => $data->vin]);
        }

        return $dealer->load('inventories');
    }

    public function viewDealerInventory($id)
    {
        $inventory = User::find($id)->withWhereHas('inventories')->get();
        return $inventory;
    }

    public function vehicleDetails($id, $vin)
    {
        $vehicle = User::find($id)->inventories->where('vin', $vin)->first();
        $vehicles = $vehicle->vin()->with('model','color','variant','body')->first();
        return $vehicles;
    }

}
