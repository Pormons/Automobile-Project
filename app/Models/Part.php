<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        "part_name",
        "part_type",
        "supplier",
        "manufactured_date"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Partner::class,"supplier","id");
    }

    public function vehicleParts(): HasMany
    {
        return $this->hasMany(VehiclePart::class,"part", "id");
    }
}
