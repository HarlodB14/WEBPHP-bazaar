<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getURLAttribute()
    {
        return URL::route('rentals.show', $this->id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_links', 'linked_advertisement_id', 'advertisement_id');
    }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['query'] ?? false) {
            $query->where('title', 'like', '%' . $filters['query'] . '%')
                ->orWhere('body', 'like', '%' . $filters['query'] . '%')
                ->orWhereHas('category', function ($query) use ($filters) {
                    $query->where('type', 'like', '%' . $filters['query'] . '%');
                })
                ->orWhere('price', 'like', '%' . $filters['query'] . '%');
        }
    }


}
