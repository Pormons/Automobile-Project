<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        "variant_name",
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function variant(): HasMany
    {
        return $this->hasMany(Variant::class,"variant","id");
    }
}
