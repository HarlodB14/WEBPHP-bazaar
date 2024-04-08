<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'advertisement_id', 'amount'];

    protected $table = 'bids';


    public function users()
    {
        return $this->belongsToMany(User::class, 'advertisement_has_bid', 'bid_id', 'user_id')->withPivot('amount');
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_has_bid');
    }


    public function moveToPurchaseHistory()
    {
        $user = $this->user;

        PurchaseHistory::create([
            'user_id' => $user->id,
            'advertisement_id' => $this->advertisement_id,
        ]);

    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['query'] ?? false) {
            $query->where('amount', 'like', '%' . $filters['query'] . '%');

        }
    }
}
