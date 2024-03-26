<?php

namespace App\Http\Controllers\Rental;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Rental;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RentalController extends Controller
{
    public function index()
    {
        $user_id = auth()->id(); // Get the authenticated user's ID
        $user = User::find($user_id); // Fetch the authenticated user object

        $rentals = Rental::with('category')->get();

        $qrCodes = [];
        foreach ($rentals as $rental) {
            $url = $rental->getURLAttribute(); // Assuming this method generates the URL
            $qrCodes[$rental->id] = QrCode::size(150)->generate($url);
        }
        return view('Rental.rental-overview', compact('rentals', 'qrCodes', 'user'));
    }

    public function agenda()
    {
        return view('Rental.rental-agenda');

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

    public function show(Rental $rental)
    {
        $user = auth()->user();
        $qrcode = QrCode::size(150)->generate($rental->getURLAttribute());

        return view('Rental.rental-detail', compact('rental', 'qrcode', 'user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $rental = Rental::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image_URL' => 'required|string',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $data['category_id'] = $request->input('category');

        $rental->update($data);

        return redirect()->route('rentals.index')->with('message', "Rental updated!");
    }

    public function saveDate(Request $request, $id)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $rental = Rental::findOrFail($id);

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $rental->start_date = $startDate;
        $rental->return_date = $endDate;

        $rental->update();

        return redirect()->route('rentals.index')->with('message', "Rental Period successfully set & saved");
    }


    public function edit($id): View
    {
        $rental = Rental::findOrFail($id);
        $categories = Category::all();
        return view('Rental.rental-update', compact('rental', 'categories'));
    }


    public function delete($id): RedirectResponse
    {
        $rental = Rental::findOrFail($id);
        $rental->delete();

        // Clear ID seeding
        DB::statement('ALTER TABLE advertisements AUTO_INCREMENT = 1');

        return redirect()->route('rentals.index')->with('message', "Rental deleted!");
    }
}
