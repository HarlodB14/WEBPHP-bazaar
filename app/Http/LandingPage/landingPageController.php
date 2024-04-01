<?php

namespace App\Http\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\CustomUrl;
use App\Models\Type;
use Illuminate\Http\Request;

class landingPageController extends Controller
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
        $types = Type::all();

        if (!$customUrl) {
            abort(404);
        } else {
            $landingPage = $customUrl->landingPage;

            if (!$landingPage) {
                return view('LandingPage.landingPage-create', compact('types'));
            }

            $components = $landingPage->components;
            return view('LandingPage.landingPage-create', compact('landingPage', 'components'));
        }
    }

}
