<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class)->withPivot('status')->withTimestamps();
    }


    public function rentals()
    {
        return $this->belongsToMany(Rental::class);
    }
    public function moveToPurchaseHistory()
    {
        $user = $this->user;

        foreach ($this->advertisements as $advertisement) {
            PurchaseHistory::create([
                'user_id' => $user->id,
                'advertisement_id' => $advertisement->id,
            ]);
        }

        foreach ($this->rentals as $rental) {
            PurchaseHistory::create([
                'user_id' => $user->id,
                'rental_id' => $rental->id,
            ]);
        }

        $this->advertisements()->detach();
        $this->rentals()->detach();
    }
}
