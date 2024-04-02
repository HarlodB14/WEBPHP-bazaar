<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\CustomUrl;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        $customUrl = $user->customUrl;

        if ($customUrl) {
            $customUrl->update(['custom_url' => $request->input('custom_url')]);
        } else {
            $customUrl = $user->customUrl()->create([
                'custom_url' => $request->input('custom_url')
            ]);
        }

        return redirect()->route('dashboard')->with('message', 'Custom URL updated successfully!');
    }


    public function showLandingPage()
    {
        $user = auth()->user();
        $customUrl = $user->customUrl;

        if (!$customUrl) {
            return redirect()->to('dashboard');
        }

        $landingPage = $user->landingPage;

        if (!$landingPage) {
            return Redirect()->route('landing-page.create')->with('message', 'No landing page found. You can create one and add components.');
        }

        $components = $landingPage->components;

        if (!isset($components)) {
            return view('LandingPage.create', ['message' => 'No components found on this landing page. You can add components Here"']);
        }

        return view('LandingPage.landingPage-show', compact('landingPage', 'components'));
    }

    public function create()
    {
        $types = Type::all();

        return view('LandingPage.landingPage-create', compact('types'));
    }

}
