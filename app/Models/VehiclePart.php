<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehiclePart extends Model
{
    use HasFactory;

    protected $fillable = [
        "vin",
        "part"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];


    public function vin(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class,"vin","vin");
    }


    public function part_info(): BelongsTo
    {
        return $this->belongsTo(Part::class,"part","id");
    }

}
