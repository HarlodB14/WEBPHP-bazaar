<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdvertController extends Controller
{

    public function index()
    {
        $user_id = auth()->id(); // Get the authenticated user's ID
        $user = User::find($user_id); // Fetch the authenticated user object

        $advertisements = Advertisement::all();

        $qrCodes = [];
        foreach ($advertisements as $advertisement) {
            $url = $advertisement->getURLAttribute(); // Assuming this method generates the URL
            $qrCodes[$advertisement->id] = QrCode::size(150)->generate($url);
        }


        return view('advertisement.advertisement-overview', compact('advertisements', 'qrCodes', 'user'));
    }

    public function show(Advertisement $advertisement)
    {
        return view('advertisement.advertisement-detail', compact('advertisement'));
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

        Advertisement::create(array_merge($data, ['advertisement_url' => $request->url()]));
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