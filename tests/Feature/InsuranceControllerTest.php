<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Insurance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InsuranceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_store_insurance_validation()
    {
        $response = $this->postJson('/api/insurances', [
            'user_id' => '',
            'provider' => '',
            'policyNumber' => '',
            'coverageType' => '',
            'validUntil' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'user_id',
                'provider',
                'policyNumber',
                'coverageType',
                'validUntil'
            ]);
    }

    public function test_store_insurance_successful_creation()
    {
        $user = User::factory()->create();
        $validUntil = now()->addYear()->format('Y-m-d');

        $response = $this->postJson('/api/insurances', [
            'user_id' => $user->id,
            'provider' => 'Test Insurance Co',
            'policyNumber' => 'POL123456',
            'coverageType' => 'Health',
            'validUntil' => $validUntil,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'user_id' => $user->id,
                'provider' => 'Test Insurance Co',
                'policyNumber' => 'POL123456',
                'coverageType' => 'Health',
                'validUntil' => $validUntil,
            ]);
    }

    public function test_update_insurance_validation()
    {
        $user = User::factory()->create();
        $insurance = Insurance::create([
            'user_id' => $user->id,
            'provider' => 'Test Insurance Co',
            'policyNumber' => 'POL123456',
            'coverageType' => 'Health',
            'validUntil' => now()->addYear(),
        ]);

        $response = $this->putJson("/api/insurances/{$insurance->id}", [
            'provider' => '',
            'policyNumber' => '',
            'coverageType' => '',
            'validUntil' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'provider',
                'policyNumber',
                'coverageType',
                'validUntil'
            ]);
    }

    public function test_update_insurance_successful_update()
    {
        $user = User::factory()->create();
        $insurance = Insurance::create([
            'user_id' => $user->id,
            'provider' => 'Test Insurance Co',
            'policyNumber' => 'POL123456',
            'coverageType' => 'Health',
            'validUntil' => now()->addYear(),
        ]);

        $validUntil = now()->addYears(2)->format('Y-m-d');

        $response = $this->putJson("/api/insurances/{$insurance->id}", [
            'provider' => 'New Insurance Co',
            'policyNumber' => 'POL789012',
            'coverageType' => 'Life',
            'validUntil' => $validUntil,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'provider' => 'New Insurance Co',
                'policyNumber' => 'POL789012',
                'coverageType' => 'Life',
                'validUntil' => $validUntil,
            ]);
    }
}
