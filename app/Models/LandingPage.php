<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Composer;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'content'];

    protected $table = 'landing_pages';

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function customUrl()
    {
        return $this->hasOne(CustomUrl::class);
    }
}
