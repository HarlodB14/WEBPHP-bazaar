<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

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
    protected $table = 'rental_advertisement';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
