<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Component;
use App\Models\LandingPage;
use App\Models\Rental;
use App\Models\Type;
use App\Models\TypeEnum;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $advertisementId = $request->advertisement_id;
        $inputId = $request->input('types_id');
        $advertisement = Advertisement::find($advertisementId);
        $content = $request->input('content');
        $landingPage = LandingPage::where('user_id', $userId)->firstOrFail();

        $component = Component::updateOrCreate(
            ['landing_page_id' => $landingPage->id, 'types_id' => $inputId, 'content' => $content],
        );

        return redirect()->back()->with('message', 'Component added or updated successfully!');
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $inputTypeId = $request->input('types_id');
        $advertisementId = $request->advertisement;
        $landingPage = LandingPage::where('user_id', $userId)->firstOrFail();
        $advertisement = Advertisement::findOrFail($advertisementId);
        $contentType = $this->checkContentType($request, $advertisement);

        $component = new Component([
            'landing_page_id' => $landingPage->id,
            'types_id' => $contentType,
            'content' => $contentType
        ]);

        $component->save();
        $component->advertisements()->attach($advertisementId);

        return redirect()->back()->with('message', 'Advertisement added successfully!');
    }

    private function checkContentType(Request $request, Advertisement $advertisement): string
    {
        $inputId = $request->input('types_id');
        $inputType = Type::where('id', $inputId)->first();


        $content = '';
        // Determine the content based on the input type
        switch ($inputType->type) {
            case TypeEnum::FeaturedAdvertisement:
                $content = $advertisement->body;
                return $content;
            case TypeEnum::IntroductionText:
                $content = $request->input('content');
                return $content;
            case TypeEnum::Image:
                // TODO: Handle image content
                // For example, you might want to save the image file and return its path
                break;
            default:
                return 'Failed to load this content type';
        }
        return $content;
    }

}
