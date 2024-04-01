<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\LandingPage;
use App\Models\Type;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $data = $request->validate([
            'content' => 'required',
            'types_id' => 'exists:types,id',
        ]);

        $landingPage = LandingPage::firstOrCreate([
            'id' => $request->landing_page_id,
            'user_id' => $userId
        ]);

        $landingPage->components()->create([
            'types_id' => $data['types_id'],
            'content' => $data['content'],
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
