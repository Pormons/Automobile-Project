<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Web\AdminPage;
use App\Livewire\Admin\Components\AddPartner;
use App\Livewire\Admin\Dealer;
use App\Livewire\Admin\DealerInventory;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\Partner;
use App\Livewire\Admin\PartnerInventory;
use App\Livewire\Admin\Transactions as AdminTransactions;
use App\Livewire\Admin\Vehicle;
use App\Livewire\Cart;
use App\Livewire\Cart\CartPage as CartCartPage;
use App\Livewire\CartPage;
use App\Livewire\Customer\Checkout;
use App\Livewire\Customer\CustomerTransaction;
use App\Livewire\Customer\Home as CustomerHome;
use App\Livewire\Customer\Transactions;
use App\Livewire\Customer\VehicleDetails;
use App\Livewire\Dealer\Dashboard;
use App\Livewire\Dealer\Inventory;
use App\Livewire\Dealer\Transaction;
use App\Livewire\Dealer\TransactionDetails;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// AUTH ------------------------------------------------------------------------>
Route::get('/',                                   CustomerHome::class)->name('home');
Route::get('/Login',    [Authentication::class,    'loginPage'])->name('login');
Route::get('/Signup',   [Authentication::class,   'signupPage'])->name('signup');
Route::get('/Cart',                               CartPage::class)->name('cart');
Route::get('/{id}',                               VehicleDetails::class)->name('vehicleDetails');


Route::middleware('auth')->group(function () {

    // ADMIN ------------------------------------------------------------------------>
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/Admin/Vehicles',                  Vehicle::class)->name('vehicles');
        Route::get('/Admin/Dealers',                   Dealer::class)->name('dealers');
        Route::get('/Admin/Vehicles/{id}',              AdminTransactions::class);
        Route::get('/Admin/Partners',                  Partner::class)->name('partners');
        Route::get('/Admin/Partners/{id}/Inventory',   PartnerInventory::class);
        Route::get('/Admin/Dealer/{id}/Inventory',     DealerInventory::class);
    });

    // DEALERS --------------------------------------------------------------------->
    Route::middleware(['role:Dealer'])->group(function () {
        Route::get('/Dealer/Home',                       Dashboard::class)->name('dealerDashboard');
        Route::get('/Dealer/Inventory',                  Inventory::class)->name('inventory');
        Route::get('/Dealer/Transactions',               Transaction::class)->name('transactions');
        Route::get('/Dealer/Transactions/{id}',          TransactionDetails::class)->name('transactionsDetails');
    });

    //CUSTOMERS -------------------------------------------------------------------->
    Route::middleware(['role:Customer'])->group(function () {
        Route::get('/{id}/Checkout',                      Checkout::class)->name('checkout');
        Route::get('Customer/Transactions',               Transactions::class)->name('transaction');
        Route::get('Customer/Transactions/{id}',          CustomerTransaction::class)->name('customerTransactionDetails');
    });
});

