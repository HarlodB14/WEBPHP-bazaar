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

        $landingPage = LandingPage::where('user_id', $userId)->firstOrFail();

        $component = Component::updateOrCreate(
            ['landing_page_id' => $landingPage->id, 'content' => $content],
        );
        return redirect()->back()->with('message', 'Component added or updated successfully!');
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $advertisementId = $request->advertisement;
        $landingPage = LandingPage::where('user_id', $userId)->firstOrFail();
        $advertisement = Advertisement::findOrFail($advertisementId);

        $component = new Component([
            'landing_page_id' => $landingPage->id,
            'types_id' => 1,
            'content' => $advertisement->body,
        ]);

        $component->save();
        $component->advertisements()->attach($advertisementId);

        return redirect()->back()->with('message', 'Advertisement added successfully!');
    }

}
