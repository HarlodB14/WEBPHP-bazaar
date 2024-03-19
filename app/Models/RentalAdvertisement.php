<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'owner_name',
        'body',
        'image_URL',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
