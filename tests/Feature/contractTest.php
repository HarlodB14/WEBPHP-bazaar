<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class contractTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_generate_contract()
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'created_at' => Carbon::now()->subDays(5), // Example created_at date
            'type' => 'Commerical advertiser',
        ]);

        // Authenticate the user
        Auth::login($user);

        // Call the generateContract method
        $response = $this->get('/generate-contract');

        // Assert response is successful
        $response->assertSuccessful();

        // Assert that the generated PDF file is downloadable
        $response->assertHeader('Content-Disposition', 'attachment; filename=contract.pdf');

        // Assert that the contract information is correctly passed to the view
        $response->assertSeeTextInOrder([
            'Current date',
            now()->toDateTimeString(),
            'Name',
            'John Doe',
            'Email',
            'john@example.com',
            'Created at',
            $user->created_at ? $user->created_at->toDateTimeString() : '',
        ]);
    }
}
