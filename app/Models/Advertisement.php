<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use mysql_xdevapi\Table;

class Advertisement extends Model
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
        'expiration_date'
    ];
    protected $table = 'advertisements';

    protected static function booted()
    {
        static::creating(function ($advertisement) {
            $advertisement->expiration_date = now()->addDays(4);
        });
    }

    public function getURLAttribute()
    {
        return URL::route('advertisements.show', $this->id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bid()
    {
        return $this->belongsToMany(Bid::class, 'advertisement_has_bid');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function components()
    {
        return $this->morphMany(Component::class, 'advertisement');
    }
    public function linkedAdvertisements()
    {
        return $this->belongsToMany(Rental::class, 'advertisement_links', 'advertisement_id', 'linked_advertisement_id');
    }
}
