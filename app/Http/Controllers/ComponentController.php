<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class componentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'content' => 'required',
        ]);

        Component::create([
            'landing_page_id' => $request->landing_page_id,
            'type' => $request->type,
            'content' => $request->inside_content,
        ]);

        return redirect()->back()->with('message', 'Component added successfully!');
    }

    public function show($landingPageId)
    {
        $landingPage = LandingPage::findOrFail($landingPageId);
        $components = $landingPage->components;

        return view('landing-page.show', compact('landingPage', 'components'));
    }
}
