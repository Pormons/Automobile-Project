<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        "color_name"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class,"color","id");
    }

}
