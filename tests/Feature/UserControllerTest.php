<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_user_validation()
    {
        $response = $this->postJson('/api/users', [
            'firstName' => '', // Invalid empty name
            'lastName' => '', // Invalid empty name
            'email' => 'not-an-email', // Invalid email
            'password' => '123', // Too short password
            'birthDate' => '2020-02-30', // Invalid date
            'isSelfPay' => 'yes', // Invalid boolean
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'firstName', 
            'lastName',
            'email', 
            'password', 
            'birthDate', 
            'isSelfPay'
        ]);
    }

    public function test_store_user_successful_creation()
    {
        $response = $this->postJson('/api/users', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'birthDate' => '1990-01-01',
            'profilePicture' => 'https://example.com/profile.jpg',
            'isSelfPay' => true,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);
    }

    public function test_update_user_validation()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'firstName' => '', // Invalid empty name
            'lastName' => '', // Invalid empty name
            'email' => 'not-an-email', // Invalid email
            'birthDate' => '2020-02-30', // Invalid date
            'isSelfPay' => 'yes', // Invalid boolean
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'firstName',
            'lastName', 
            'email',
            'birthDate',
            'isSelfPay'
        ]);
    }

    public function test_update_user_successful_update()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'email' => 'jane.smith@example.com',
            'birthDate' => '1995-01-01',
            'isSelfPay' => false,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'email' => 'jane.smith@example.com',
        ]);
    }
}