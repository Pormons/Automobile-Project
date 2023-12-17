<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "address",
        "gender",
        "annual_income"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user","id");
    }


}
