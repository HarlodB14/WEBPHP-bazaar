<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'user_id'
    ];
    protected $table = 'advertisements';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
