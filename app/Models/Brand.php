<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        "brand_name",
        "image_url"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function brandmodels(): HasMany
    {
        return $this->hasMany(BrandModel::class,"brand","id");
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class,"brand","id");
    }
}
