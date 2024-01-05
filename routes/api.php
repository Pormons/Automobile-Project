<?php

use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\AdminPage;
use App\Http\Controllers\Api\Dealer;
use App\Http\Controllers\Api\DealerController;
use App\Http\Controllers\Api\Listing;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/getPartner',[Admin::class, 'partnerview']);

Route::get('/getUser',[DealerController::class, 'getUser']);

Route::post('/Login', [Authentication::class, 'login' ])->name('login');
Route::post('/Register',[Authentication::class,'register'])->name('register');

Route::middleware('auth:sanctum')->group( function() {

    Route::get('Dealer/Inventory', [Dealer::class, 'viewInventory']);
    Route::get('Dealer/Transactions', [Dealer::class, 'viewTransactions']);


});

Route::controller(AdminPage::class)->group(function() {

    //Registered Vehicle Page
    Route::post('/Vehicles',         'storeVehicles');
    Route::post('/Vehicles',          'viewVehicles');
    Route::get('/VehicleInfo/{vin}', 'vehicleInfo');

    //Supplier Page

});

Route::post('/Listings',[Listing::class, 'viewListings']);

Route::post('/Manufacturers',[Admin::class,'storeManufacturer']);
Route::get('/Manufacturers',[Admin::class,'viewManufacturer']);

Route::post('/Suppliers',[Admin::class,'storeSupplier']);
Route::get('/Suppliers',[Admin::class,'viewSupplier']);

Route::post('/Dealers/Create',[Admin::class,'storeDealers']);
Route::delete('/Dealers/{id}',[Admin::class,'deleteDealer']);
Route::post('/Dealers',[Admin::class,'viewDealers']);

Route::post('/Brands',[Admin::class,'storeBrands']);
Route::get('/Brands',[Admin::class,'viewBrands']);

Route::post('/Variants',[Admin::class,'storeVariants']);
Route::get('/Variants',[Admin::class,'viewVariants']);

Route::post('/BodyStyles',[Admin::class,'storeBodyStyles']);
Route::get('/BodyStyles',[Admin::class,'viewBodyStyles']);

Route::post('/BrandModels',[Admin::class,'storeBrandModels']);


Route::get('/Transactions',[Admin::class,'viewTransactions']);
Route::post('/Purchase',[Admin::class,'purchaseVehicle']);


Route::post('/Colors',[Admin::class,'storeColors']);
Route::get('/Colors',[Admin::class,'viewColors']);

Route::post('/Parts',[Admin::class,'storeParts']);
Route::get('/Parts',[Admin::class,'viewParts']);


Route::post('/brandModels',[Admin::class,'storebrandModels']);
Route::get('/brandModels',[Admin::class,'viewbrandModels']);

Route::post('/Inventory',[Admin::class,'storeDealerInventory']);
Route::get('/Inventory/{id}',[Admin::class,'viewDealerInventory']);

Route::get('/Inventory/{id}/{vin}',[Admin::class,'vehicleDetails']);


