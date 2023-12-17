<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\ModelName;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class Listing extends Controller
{

    // public function viewListings(Request $request)
    // {
    //     $brandModels = ModelName::has('brandmodels.vehicles.inventory')
    //     ->with(['brandmodels' => function ($query) use ($request) {
    //         $query->has('vehicles.inventory.dealer')
    //             ->with('brand', 'vehicleParts.part')
    //             ->where(function ($query) use ($request) {
    //                 $query->when($request->engine, function ($query, $engine) {
    //                     $query->orWhereHas('vehicleParts.part', function ($query) use ($engine) {
    //                         $query->where('part', $engine);
    //                     });
    //                 })
    //                 ->when($request->brand_name, function ($query, $brand_name) {
    //                     $query->orWhereHas('brand', function ($query) use ($brand_name) {
    //                         $query->where('brand_name', $brand_name);
    //                     });
    //                 })
    //                 ->when($request->search, function ($query, $search) {
    //                     $query->orWhereHas('brand', function ($query) use ($search) {
    //                         $query->where('model', 'LIKE', '%' . $search . '%');
    //                     });
    //                 })
    //                 ->when($request->transmission, function ($query, $transmission) {
    //                     $query->whereHas('vehicleParts.part', function ($query) use ($transmission) {
    //                         $query->where('part', $transmission);
    //                     });
    //                 });
    //             });
    //     }])
    //     ->when($request->search, function ($query, $search) {
    //         $query->where('model', 'LIKE', '%' . $search . '%');
    //     })
    //     ->get();

    //     return $brandModels;
    // }

    public function viewListings(Request $request){

        $query = ModelName::has('brandmodels.vehicles.inventory')
        ->with('brandmodels.vehicleParts.part','brandmodels.brand')
        ->whereHas('brandmodels.vehicleParts.part', function ($subQuery) use ($request) {
            $subQuery->where('part', $request->engine);
        })
        ->whereHas('brandmodels.vehicleParts.part', function ($subQuery) use ($request) {
            $subQuery->where('part', $request->transmission);
        })
        ->get();

        return $query;
    }


    // public function viewListings(Request $request)
    // {
    //     $vehicles = BrandModel::has('vehicles')
    //     ->with('brand', 'bodystyle', 'vehicleParts.part','vehicles.inventory.dealer')
        // ->whereHas('vehicleParts.part', function ($query) use ($request) {
        //     $query->when($request->transmission, function ($query, $transmission) {
        //         $query->where('part', $transmission);
        //     });
        // })
        // ->where(function ($query) use ($request) {
        //     $query->when($request->engine, function ($query, $engine) {
        //         $query->orWhereHas('vehicleParts.part', function ($query) use ($engine) {
        //             $query->where('part', $engine);
        //         });
        //     });
        // })
        // ->where(function ($query) use ($request) {
        //     $query->when($request->brand_name, function ($query, $brand_name) {
        //         $query->orWhereHas('brand', function ($query) use ($brand_name) {
        //             $query->where('brand_name', $brand_name);
        //         });
        //     });
        // })
        // ->where(function ($query) use ($request) {
        //     $query->when($request->search, function ($query, $search) {
        //         $query->where('model_name','LIKE','%'.$search.'%');
        //     });
        // })
        // ->where(function ($query) use ($request) {
        //     $query->when($request->brand_name, function ($query, $brand_name) {
        //         $query->orWhereHas('brand', function ($query) use ($brand_name) {
        //             $query->where('brand_name', $brand_name);
        //         });
        //     });
        // })
    //     ->get();

    //     return $vehicles;
    // }

    // public function viewListings(Request $request)
    // {
    //     $vehicles = BrandModel::has('')

    //     return $vehicles;
    // }



}
