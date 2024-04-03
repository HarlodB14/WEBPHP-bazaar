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
        $data['advertisements_id'] = $advertisementId;

        // Find or create the landing page associated with the user
        $landingPage = LandingPage::firstOrCreate([
            'id' => $request->landing_page_id,
            'user_id' => $userId
        ]);

        // Find or create the component associated with the landing page and advertisement
        $component = Component::updateOrCreate(
            ['landing_page_id' => $landingPage->id, 'advertisements_id' => $advertisementId],
            $data
        );

        return redirect()->back()->with('message', 'Component added or updated successfully!');
    }


    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $advertisementId = $request->advertisement;
        $advertisement = Advertisement::findOrFail($advertisementId);

        $landingPage = LandingPage::find(['user_id' => $userId]);
//        if(!isset($landingPage)){
//
//        }

        // Find the existing component by advertisement ID
        $existingComponent = Component::where('advertisements_id', $advertisementId)
            ->first();

        // If an existing component is found, update it. Otherwise, create a new one.
        if ($existingComponent) {
            $existingComponent->update([
                'types_id' => $request->types_id,
                'content' => $advertisement->body
            ]);
//        } else {
//            // Create a new component
//            $component = Component::create([
//                'advertisements_id' => $advertisementId,
//                'types_id' => $request->types_id,
//                'content' => $advertisement->body
//            ]);
        }

        return redirect()->back()->with('message', 'Advertisement added or updated successfully!');
    }

}
