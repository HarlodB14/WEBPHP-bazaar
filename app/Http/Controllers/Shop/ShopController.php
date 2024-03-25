<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;

class ShopController extends Controller
{

    public function addItem($advertisementId)
    {
        $user = auth()->user();
        $basket = $user->basket;

        if (!$basket) {
            $basket = $user->basket()->create([]);
            $user->save();
        } else {
            if ($basket->advertisements()->where('advertisement_id', $advertisementId)->exists()) {
                return redirect()->route('advertisements.index')->with('error', "You already have this item in your basket");
            }
        }

        $basket->advertisements()->attach($advertisementId);

        return redirect()->route('advertisements.index')->with('message', 'Advertisement-item has been added to your basket!');
    }



}
