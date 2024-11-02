<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PhoneNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhoneNumberControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_store_phone_number_validation()
    {
        $response = $this->postJson('/api/phone-numbers', [
            'user_id' => '',
            'phoneNumber' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id', 'phoneNumber']);
    }

    public function test_store_phone_number_successful_creation()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/phone-numbers', [
            'user_id' => $user->id,
            'phoneNumber' => '123-456-7890',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'user_id' => $user->id,
                'phoneNumber' => '123-456-7890',
            ]);
    }

    public function test_update_phone_number_validation()
    {
        $user = User::factory()->create();
        $phoneNumber = PhoneNumber::create([
            'user_id' => $user->id,
            'phoneNumber' => '123-456-7890'
        ]);

        $response = $this->putJson("/api/phone-numbers/{$phoneNumber->id}", [
            'phoneNumber' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phoneNumber']);
    }

    public function test_update_phone_number_successful_update()
    {
        $user = User::factory()->create();
        $phoneNumber = PhoneNumber::create([
            'user_id' => $user->id,
            'phoneNumber' => '123-456-7890'
        ]);

        $response = $this->putJson("/api/phone-numbers/{$phoneNumber->id}", [
            'phoneNumber' => '987-654-3210',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'phoneNumber' => '987-654-3210',
            ]);
    }
}