<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        "partner_name",
        "partner_email",
        "partner_phone",
        "partner_address",
        "partner_type"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function parts(): HasMany
    {
        return $this->hasMany(Part::class,"supplier","id");
    }

    public function brandmodels(): HasMany
    {
        return $this->hasMany(BrandModel::class,"manufacturer","id");
    }
}
