<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer",
        "dealer",
        "purchase_date",
        "status"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    protected $primaryKey = 'transaction_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(function (Transaction $transaction) {
            $val1 = Str::uuid()->toString();
            $val2 = Str::uuid()->toString() . time();
            $transaction_code = substr($val1, 0, 5) . '-' . substr($val2, 33, 8);
            $transaction->transaction_id = strtoupper($transaction_code);
        });
    }

    public function customer_info(): BelongsTo
    {
        return $this->belongsTo(User::class,"customer","id");
    }

    public function dealer_info(): BelongsTo
    {
        return $this->belongsTo(User::class,"dealer","id");
    }

    public function purchasedVehicles(): HasMany
    {
        return $this->hasMany(PurchasedVehicle::class,"transaction","transaction_id");
    }

}
