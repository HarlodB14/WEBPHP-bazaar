<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_page_id',
        'types_id',
        'content',
    ];

    public function landingPage()
    {
        return $this->belongsTo(LandingPage::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }

}
