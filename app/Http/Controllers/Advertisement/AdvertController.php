<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Bid;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdvertController extends Controller
{

    public function index(Request $request)
    {
        $user_id = auth()->id();
        $user = User::find($user_id);

        $searchQuery = $request->input('query');
        $advertisementsQuery = Advertisement::with('category');
        if ($searchQuery) {
            $advertisementsQuery->filter(['query' => $searchQuery]);
        }
        $advertisements = $advertisementsQuery->paginate(6);
        // Generate QR codes for each advertisement
        $qrCodes = [];
        foreach ($advertisements as $advertisement) {
            $url = $advertisement->getURLAttribute();
            $qrCodes[$advertisement->id] = QrCode::size(150)->generate($url);
        }

        return view('advertisement.advertisement-overview', compact('advertisements', 'qrCodes', 'user'));
    }

    public function storeUpload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $fileName = $file->getClientOriginalName();
        try {
            $file->move(public_path('csv-files'), $fileName);

            $filePath = public_path('csv-files') . '\\' . $fileName;
            $this->importCsv($filePath);

            return redirect()->route('advertisements.index')->with('message', 'Advertisements uploaded successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error uploading advertisements: ' . $e->getMessage());
        }
    }


    public function importCsv($filePath)
    {
        $advertisementsArray = $this->csvToArray($filePath);
        $userId = auth()->user()->id;

        foreach ($advertisementsArray as $advertisementData) {
            //BOM characters weghalen
            $advertisementData = array_map(function ($key, $value) {
                $key = trim(preg_replace('/\x{FEFF}/u', '', $key));
                return [$key => $value];
            }, array_keys($advertisementData), $advertisementData);


            $advertisementData = array_reduce($advertisementData, 'array_merge', []);

            $categoryName = $advertisementData['Category'];
            $title = $advertisementData['Title'] ?? null;
            $body = $advertisementData['Body'] ?? '';
            $imageUrl = $advertisementData['Image URL'] ?? '';
            $price = $advertisementData['Price'] ?? null;

            $category = Category::where('type', $categoryName)->first();

            if (!$category) {
                $category = Category::create(['type' => $categoryName]);
            }

            $advertisementData['category_id'] = $category->id;
            unset($advertisementData['Category']);

            $advertisementData['user_id'] = $userId;

            Advertisement::create(array_merge($advertisementData, ['title' => $title, 'body' => $body, 'image_URL' => $imageUrl, 'price' => $price]));
        }

        return redirect()->route('advertisements.index')->with('message', 'Advertisements uploaded successfully.');
    }


    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {

                if (!$header) {
                    $header = $row;
                } else {
                    if (count($row) !== count($header)) {
                        continue;
                    }
                    $rowData = array_combine($header, $row);
                    $rowData = array_map('trim', $rowData);
                    $data[] = $rowData;
                }
            }
            fclose($handle);
        }

        return $data;
    }


    public function upload(): view
    {
        return view('advertisement.advertisement-upload');
    }

    public function agenda(): view
    {
        return view('Advertisement.advertisement-agenda');
    }

    public function fetchAdvertisementData(): JsonResponse
    {
        $user = auth()->user();
        $advertisementQuery = Advertisement::with('category');

        if ($user->hasRole(['Viewer'])) {
            $advertisements = $advertisementQuery->get();
        } else {
            $advertisements = $user->advertisement()->with('category')->get();
        }

        return response()->json($advertisements);
    }

    public function show(Advertisement $advertisement): view
    {
        $user = auth()->user();
        $qrcode = QrCode::size(150)->generate($advertisement->getURLAttribute());
        $highestBid = Bid::max('amount');

        $currentBids = Bid::where('advertisement_id', $advertisement->id)
            ->whereHas('users');


        return view('advertisement.advertisement-detail', compact('advertisement', 'qrcode', 'user', 'currentBids', 'highestBid'));
    }


    public function create()
    {
        $user = auth()->user();
        if ($user->advertisement()->count() >= 4) {
            return redirect()->back()->with('error', "You can only create a maximum of 4 advertisements.");
        }

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
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

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
