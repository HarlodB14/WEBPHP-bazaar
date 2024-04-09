<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class storeImageTests extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_image()
    {
        $file = UploadedFile::fake()->image('test_image.jpg');

        $response = $this->post(route('image.store'), [
            'image' => $file,
        ]);

        $response->assertStatus(302);

        Storage::disk('public')->assertExists('images/' . $file->hashName());

        $response->assertSessionHas('success', 'Image uploaded Successfully!');
    }
}
