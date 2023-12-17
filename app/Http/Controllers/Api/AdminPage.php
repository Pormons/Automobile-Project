<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPage extends Controller
{

    //Register Vehicle Page -------------------------------------------------------------------------

    public function storeVehicles(Request $request)
    {
        try {
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
            return $vehicle->load('model', 'variant', 'color', 'body', 'vehicleparts');
        } catch (Exception $e) {
            if ($vehicle) {
                $vehicle->delete();
            }
            return response()->json(['error' => 'Something went wrong']);
        }
    }

    public function viewVehicles(Request $request)
    {
        $vehicle = Vehicle::with('model.brand', 'variant', 'color', 'body','inventories.dealer')
        ->when($request->filled('model'), function ($query) use ($request) {
            $query->whereHas('model', function ($query) use ($request) {
                $query->where('model_name', $request->model);
            });
        })
        ->when($request->filled('brand'), function ($query) use ($request) {
            $query->orWhereHas('model.brand', function ($query) use ($request) {
                $query->where('brand_name', $request->brand);
            });
        })
        ->get();
        return $vehicle;
    }


    public function vehicleInfo($vin)
    {

        $info = Vehicle::where('vin', $vin)
            ->with('model.manufacturer', 'variant', 'color', 'body', 'vehicleParts.part.supplier')
            ->first();
        return $info;
    }

    // Dealer Page ---------------------------------------------------------------------------

    public function addDealer(Request $request)
    {

    }
}
