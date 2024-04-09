<?php

namespace Tests\Feature;

use App\Http\Controllers\Advertisement\AdvertController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\TestCase;

class QrcodeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_valid_csv_file()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->createWithContent('test.csv', "column1,column2\nvalue1,value2\n");

        $response = $this->post(route('upload'), ['csv_file' => $file]);

        $response->assertRedirect(route('advertisements.index'))
            ->assertSessionHas('message', 'Advertisements uploaded successfully.');

        Storage::disk('public')->assertExists('csv-files/' . $file->hashName());
    }

    /**
     * Test storing an invalid file type.
     */
    public function test_store_invalid_file_type()
    {
        $response = $this->post(route('upload'), ['csv_file' => UploadedFile::fake()->image('test.jpg')]);

        $response->assertRedirect(route('advertisements.index'))
            ->assertSessionHasErrors('csv_file');
    }

    /**
     * Test storing a file exceeding maximum size.
     */
    public function test_store_file_exceeding_max_size()
    {
        $file = UploadedFile::fake()->create('test.csv', 3000); // Creating a file larger than the maximum allowed size

        $response = $this->post(route('upload'), ['csv_file' => $file]);

        $response->assertRedirect(route('advertisements.index'))
            ->assertSessionHasErrors('csv_file');
    }

    /**
     * Test storing a file with an exception.
     */
    public function test_store_file_with_exception()
    {
        // Mock the controller to throw an exception
        $this->mock(AdvertController::class, function ($mock) {
            $mock->shouldReceive('importCsv')->andThrow(new \Exception('Some error occurred'));
        });

        $file = UploadedFile::fake()->create('test.csv');

        $response = $this->post(route('upload'), ['csv_file' => $file]);

        $response->assertRedirect()
            ->assertSessionHas('error', 'Error uploading advertisements: Some error occurred');
    }
}
