<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Component;
use App\Models\CustomUrl;
use App\Models\LandingPage;
use App\Models\Rental;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class LandingPageController extends Controller
{
    public function setCustomUrl(Request $request)
    {
        $request->validate([
            'custom_url' => ['required', 'regex:/^[a-zA-Z0-9_\-\/]+$/'],
        ], [
            'custom_url.regex' => 'The custom URL must contain only letters, numbers, underscores, hyphens, and slashes.'
        ]);

        $user = auth()->user();
        $inputCustomUrl = $request->input('custom_url');

        $existingUrl = CustomUrl::where('custom_url', $inputCustomUrl)->first();

        if ($existingUrl && $existingUrl->user_id !== $user->id) {
            return redirect()->back()->withErrors(['custom_url' => 'The custom URL is already in use. Please choose a different one.']);
        }
        $existingRoute = Route::getRoutes()->getByName($inputCustomUrl);
        if ($existingRoute) {
            return redirect()->back()->withErrors(['custom_url' => 'The custom URL conflicts with an existing route. Please choose a different one.']);
        }
        $customUrl = $user->customUrl;
        if ($customUrl) {
            $customUrl->update(['custom_url' => $inputCustomUrl]);
        } else {
            $customUrl = $user->customUrl()->create([
                'custom_url' => $inputCustomUrl
            ]);
        }

        return redirect()->route('dashboard')->with('message', 'Custom URL updated successfully!');
    }


    public function showLandingPage()
    {
        $user = auth()->user();
        $userId = $user->id;
        $customUrl = $user->customUrl;

        if (!$customUrl) {
            return redirect()->to('dashboard');
        }

        $landingPage = $user->landingPage;

        if (!$landingPage) {
            $landingPage = LandingPage::create([
                'user_id' => $userId
            ]);
            return redirect()->route('landing-page.create')
                ->with('message', 'No landing page found. You can create one and add components.');
        }
        $components = $landingPage->components()->get();
        if ($components->isEmpty()) {
            return view('LandingPage.landingPage-show', ['components' => $components])->with('message', 'No components found on this landing page. You can add components Here');
        }

        return view('LandingPage.landingPage-show', compact('landingPage', 'components'));
    }

    public function getFeaturedAdvertisements()
    {
        $advertisements = Advertisement::with('category')
            ->where('user_id', auth()->user()->id)
            ->get();

        $rentals = Rental::with('category')
            ->where('user_id', auth()->user()->id)
            ->get();

        $featuredAdvertisements = $advertisements->concat($rentals);

        return $featuredAdvertisements;
    }


    public function create()
    {
        $user = auth()->user();
        $userId = $user->id;
        $types = Type::all();
        $featuredAdvertisements = $this->getFeaturedAdvertisements();
        $customUrl = CustomUrl::where('user_id', $userId)->first();

        return view('LandingPage.landingPage-create', compact('types', 'featuredAdvertisements', 'customUrl'));
    }

}
