<?php

namespace App\Http\Controllers\Bid;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{

    public function placeBid(Request $request, $advertisementId)
    {
        $user = auth()->user();
        $advertisement = Advertisement::findOrFail($advertisementId);

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
        ]);
        if ($validator->fails()) {
            Session::flash('bid_errors', $validator->errors()->all());
            return redirect()->route('advertisements.show', $advertisementId)->with('error', 'Please fill in a positive number');
        }
        $userBidCount = $user->bids()->count();
        if ($userBidCount >= 4) {
            return redirect()->route('advertisements.index')
                ->with('error', 'Your maximum amount of bids (4) has been reached');
        } else {
            $bid = new Bid();
            $bid->user_id = $user->id;
            $bid->advertisement_id = $advertisementId;


            if ($request->has('amount')) {
                $bid->amount = $request->input('amount');
            } else {
                return redirect()->route('advertisements.index')
                    ->with('error', 'Please provide an amount for your bid.');
            }

            $bid->save();


            $advertisement->bid()->attach($bid->id, ['user_id' => $user->id, 'amount' => $bid->amount]);

            return redirect()->route('advertisements.index')
                ->with('message', 'Your bid has been placed for ' . $advertisement->title . '!');
        }
    }


    public function index(Request $request)
    {
        $user = auth()->user();
        $searchQuery = $request->input('query');
        $bidsQuery = Bid::where('user_id', $user->id)->with('advertisements.owner');

        if ($searchQuery) {
            $bidsQuery->filter(['query' => $searchQuery]);
        }
        $bids = $bidsQuery->get();

        $bidDetails = [];
        foreach ($bids as $bid) {
            foreach ($bid->advertisements as $advertisement) {
                $bidDetails[] = [
                    'bid_id' => $bid->id,
                    'advertisement_id' => $advertisement->id,
                    'advertisement_title' => $advertisement->title,
                    'advertisement_category' => $advertisement->category->type,
                    'advertisement_owner' => $advertisement->owner->name,
                    'advertisement_price' => $advertisement->price,
                    'bid_amount' => $bid->amount,
                ];
            }
        }

        return view('Bid.bid-overview', compact('bidDetails'));
    }

    public function delete($id)
    {
        $bid = Bid::findOrFail($id);
        $itemName = "";

        if ($bid->advertisements->isNotEmpty()) {
            foreach ($bid->advertisements as $advertisement) {
                $itemName .= $advertisement->title . ", ";
            }
            $itemName = rtrim($itemName, ", ");
        }

        $bid->advertisements()->detach();

        $bid->delete();

        DB::statement('ALTER TABLE advertisements AUTO_INCREMENT = 1');

        return redirect()->route('bid.show')->with('message', "The bid on item: " . $itemName . " has been revoked!");
    }


}
