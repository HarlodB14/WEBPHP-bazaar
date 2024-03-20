<?php

namespace App\Http\rental;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RentalAdvertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentalController extends Controller
{

    public function index()
    {
        $advertisements = RentalAdvertisement::all();
        $user = auth()->user();
        return view('Advertisement.advertisement-overview', compact('advertisements', 'user'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('Advertisement.create-new-advertisement',compact('categories'));
    }

    public function store(Request $request)
    {
        // Retrieve input values from the request
        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'owner_name' => 'required|string',
            'body' => 'required|string',
            'image_URL' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $advertisement = new RentalAdvertisement($data);
        $advertisement->user_id = auth()->id();
        $advertisement->save();

        return redirect()->route('advertisement')->with('message', "New advertisement created and succesfully published!");
    }

}
