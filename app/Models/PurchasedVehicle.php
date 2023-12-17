<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PurchasedVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        "transaction",
        "inventory_id",
        "price"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function transactionInfo(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,"transaction","transaction_id");
    }

    public function dealer_inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,"inventory_id","id");
    }

}
