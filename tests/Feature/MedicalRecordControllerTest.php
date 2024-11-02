<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_store_medical_record_validation()
    {
        $response = $this->postJson('/api/medical-records', [
            'user_id' => '',
            'date' => '',
            'condition' => '',
            'treatment' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['user_id', 'date', 'condition', 'treatment']);
    }

    public function test_store_medical_record_successful_creation()
    {
        $response = $this->postJson('/api/medical-records', [
            'user_id' => $this->user->id,
            'date' => now()->format('Y-m-d'),
            'condition' => 'Chronic pain',
            'treatment' => 'Physical therapy',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'medicalRecord']);
        $this->assertDatabaseHas('medical_records', ['condition' => 'Chronic pain']);
    }

    public function test_update_medical_record_validation()
    {
        $medicalRecord = MedicalRecord::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->putJson("/api/medical-records/{$medicalRecord->id}", [
            'date' => '',
            'condition' => '',
            'treatment' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['date', 'condition', 'treatment']);
    }

    public function test_update_medical_record_successful_update()
    {
        $medicalRecord = MedicalRecord::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->putJson("/api/medical-records/{$medicalRecord->id}", [
            'date' => now()->format('Y-m-d'),
            'condition' => 'Updated condition',
            'treatment' => 'Updated treatment',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'medicalRecord']);
        $this->assertDatabaseHas('medical_records', [
            'id' => $medicalRecord->id,
            'condition' => 'Updated condition'
        ]);
    }
}