<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DealerController extends Controller
{
    public function getUser()
    {
        $currentYear = now()->year;

        $user = User::findOrFail(2);
        $annual = $user->inventories->count();

        return $annual;
    }
}
