<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        "dealer",
        "vin",
        "sold_status",
        "available",
        "retail_price"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function vin_info(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class,"vin","vin");
    }

    public function dealer_info(): BelongsTo
    {
        return $this->belongsTo(User::class,"dealer","id");
    }

    public function purchasedVehicles(): HasMany
    {
        return $this->hasMany(PurchasedVehicle::class,"inventory_id","id");
    }

}
