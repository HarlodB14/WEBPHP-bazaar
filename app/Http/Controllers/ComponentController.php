<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Component;
use App\Models\LandingPage;
use App\Models\Rental;
use App\Models\Type;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $advertisementId = $request->advertisement_id;
        $advertisement = Advertisement::find($advertisementId);
        $content = $advertisement->body;



        $data = $request->validate([
            'types_id' => 'exists:types,id',
            'advertisement_id' => 'required|exists:advertisements,id'
        ]);
        $data['content'] = $content;
        $data['advertisement_id'] = $advertisementId;

        $landingPage = LandingPage::firstOrCreate([
            'id' => $request->landing_page_id,
            'user_id' => $userId
        ]);

        $component = $landingPage->components()->first();

        if ($component) {
            $component->update([
                'types_id' => $data['types_id'],
                'advertisement_id' => $data['advertisement_id'],
                'content' => $data['content']
            ]);
        } else {
            $component = $landingPage->components()->create([
                'types_id' => $data['types_id'],
                'advertisement_id' => $data['advertisement_id'],
                'content' => $data['content']
            ]);
        }

        return redirect()->back()->with('message', 'Component added successfully!');
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $advertisementId = $request->input('advertisement_id');


        // Inspect form data

        $landingPage = LandingPage::where('user_id', $userId)->first();


        if ($landingPage) {
            $landingPageId = $landingPage->id;

            $component = new Component();
            $component->advertisements_id = $advertisementId;
            $component->landing_page_id = $landingPageId;
            $component->save();

            return redirect()->back()->with('message', 'Advertisement added to your component!');
        } else {
            return redirect()->back()->with('error', 'Landing-page could not be found, try again');
        }
    }



}
