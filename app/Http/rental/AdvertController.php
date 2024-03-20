<?php

namespace App\Http\rental;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdvertController extends Controller
{

    public function index(): View
    {
        $advertisements = Advertisement::all();
        $user = auth()->user();
        return view('Advertisement.advertisement-overview', compact('advertisements', 'user'));
    }


    public function create(): View
    {
        $categories = Category::all();
        return view('Advertisement.create-new-advertisement', compact('categories'));
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

        Advertisement::create($data);
        return redirect()->route('advertisements')->with('message', "New advertisement created and successfully published!");
    }

    public function edit()
    {

    }



}
