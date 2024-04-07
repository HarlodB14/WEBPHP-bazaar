<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['type'];
    protected $Table = ['types'];


    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function advertisements(){
        return $this->hasMany(Advertisement::class);
    }

}
