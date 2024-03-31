<?php

namespace App\Http\CustomURL;

use App\Http\Controllers\Controller;
use App\Models\CustomUrl;
use Illuminate\Http\Request;

class CustomUrlController extends Controller
{
    public function setCustomUrl(Request $request)
    {
        $request->validate([
            'custom_url' => ['required', 'unique:custom_urls,custom_url', 'regex:/^[a-zA-Z0-9_\-\/]+$/'],
        ], [
            'custom_url.regex' => 'The custom URL must be unique and contain only letters, numbers, underscores, hyphens, and slashes.'
        ]);

        $user = auth()->user();

        if ($user->hasRole('Commercial advertiser')) {
            $url = $user->customUrl()->create([
                'custom_url' => $request->input('custom_url')
            ]);
            $url->update(['custom_url' => $request->input('custom_url')]);
            return redirect()->to('/' . $request->input('custom_url'));
        }

        return redirect()->route('dashboard')->with('message', 'You do not have permission to set a custom URL.');
    }

    public function showCustomUrl($customUrl)
    {

        $landingPageData = [
            'customUrl' => $customUrl,
        ];

        return view('Home.landing-page', $landingPageData);
    }

}
