<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'owner_name',
        'body',
        'image_URL',
        'price',
        'user_id',
        'handover_date',
        'return_date',
    ];
}
