<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $advertisement = Advertisement::findOrFail($advertisementId);

        $basket->advertisements()->attach($advertisementId);

        return redirect()->route('advertisements.index')->with('message', 'Advertisement "' . $advertisement->title . '" has been added to your basket!');
    }


    public function index()
    {
        $user = auth()->user();
        $baskets = Basket::where('user_id', $user->id)->with('advertisements')->get();


        return view('Basket.basket-overview', compact('baskets'));
    }


    public function delete($id)
    {
        $basket = Basket::findOrFail($id);
        $itemName = "";

        if ($basket->advertisements->isNotEmpty()) {
            foreach ($basket->advertisements as $advertisement) {
                $itemName .= $advertisement->title . ", ";
            }
            $itemName = rtrim($itemName, ", ");
        }

        $basket->delete();

        DB::statement('ALTER TABLE advertisements AUTO_INCREMENT = 1');

        return redirect()->route('basket.show')->with('message', "The item: " . $itemName . " has been deleted from your Cart!");
    }


}
