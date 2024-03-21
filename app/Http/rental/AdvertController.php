<?php

namespace App\Http\rental;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return redirect()->route('advertisements.index')->with('message', "New advertisement created and successfully published!");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $advertisement = Advertisement::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image_URL' => 'required|string',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $data['category_id'] = $request->input('category');

        $advertisement->update($data);

        return redirect()->route('advertisements.index')->with('message', "Advertisement updated!");
    }


    public function edit($id): View
    {
        $advertisement = Advertisement::findOrFail($id);
        $categories = Category::all();
        return view('Advertisement.advertisement-update', compact('advertisement', 'categories'));
    }





    public function delete($id): RedirectResponse
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();

        // Clear ID seeding
        DB::statement('ALTER TABLE advertisements AUTO_INCREMENT = 1');

        return redirect()->route('advertisements.index')->with('message', "Advertisement deleted!");
    }



}
