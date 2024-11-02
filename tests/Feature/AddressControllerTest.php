<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_address_validation()
    {
        $response = $this->postJson('/api/addresses', [
            'user_id' => '', // Invalid empty user_id
            'address' => '', // Invalid empty address
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['user_id', 'address']);
    }

    public function test_store_address_successful_creation()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/addresses', [
            'user_id' => $user->id,
            'address' => '123 Main Street',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'address' => '123 Main Street'
        ]);
    }

    public function test_update_address_validation()
    {
        $address = Address::factory()->create();

        $response = $this->putJson("/api/addresses/{$address->id}", [
            'address' => '', // Invalid empty address
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['address']);
    }

    public function test_update_address_successful_update()
    {
        $address = Address::factory()->create();
        $newAddressText = '456 New Street';

        $response = $this->putJson("/api/addresses/{$address->id}", [
            'address' => $newAddressText,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'address' => $newAddressText,
        ]);
    }
}