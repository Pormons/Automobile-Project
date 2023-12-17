<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyStyle extends Model
{
    use HasFactory;

    protected $fillable = [
        "body_style"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];


}
