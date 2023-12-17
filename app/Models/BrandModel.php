<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BrandModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "model_name",
        "brand",
        "image_url",
        "manufacturer"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function brand_info(): BelongsTo
    {
        return $this->belongsTo(Brand::class,"brand","id");
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Partner::class,"manufacturer","id");
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class,"model","id");
    }
}
