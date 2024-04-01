<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return view('Image.image-form');
    }

    // Store Image
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('images'), $imageName);


        return back()->with('success', 'Image uploaded Successfully!')
            ->with('image', $imageName);
    }
}
