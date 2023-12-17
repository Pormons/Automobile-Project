<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Faker\Factory as Faker;
use Faker\Provider\Fakecar;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        "vin",
        "brand",
        "model",
        "variant",
        "color",
        "body",
        "model_year",
        "price",
        "status",
        "available",
        "image_url",
        "manufactured_date"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    protected $primaryKey = 'vin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(function (Vehicle $vehicle) {
            $faker = Faker::create();
            $faker->addProvider(new Fakecar($faker));
            $vehicle->vin = strtoupper($faker->vin);
        });
    }

    public function brand_info(): BelongsTo
    {
        return $this->belongsTo(Brand::class,"brand","id");
    }

    public function model_info(): BelongsTo
    {
        return $this->belongsTo(BrandModel::class,"model","id");
    }

    public function variant_info(): BelongsTo
    {
        return $this->belongsTo(Variant::class,"variant","id");
    }

    public function color_info(): BelongsTo
    {
        return $this->belongsTo(Color::class,"color","id");
    }

    public function body_info(): BelongsTo
    {
        return $this->belongsTo(BodyStyle::class,"body","id");
    }

    public function vehicleparts(): HasMany
    {
        return $this->hasMany(VehiclePart::class,"vin","vin");
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class,"vin","vin");
    }

}
