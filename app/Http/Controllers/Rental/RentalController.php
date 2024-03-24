<?php

namespace App\Http\Controllers\Rental;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Rental;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view('Rental.rental-overview');
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->rental()->count() >= 4) {
            return redirect()->back()->with('error', "You can only create a maximum of 4 Rental advertisements.");
        }

        $categories = Category::all();
        return view('Rental.rental-create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $user_id = $user->id;

        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image_URL' => 'required|string',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $data['user_id'] = $user_id;
        $data['category_id'] = $request->input('category');

        Rental::create($data);
        return redirect()->route('rentals.index')->with('message', "New Rental Item created and successfully published!");
    }
}
