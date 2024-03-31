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

    public function showCustomUrl()
    {
        $user = auth()->user();
        $id = $user->customUrl();
        if (!$id) {
            abort(404);
        }

        return view('Home.landing-page', ['customUrl' => $id]);
    }

}
