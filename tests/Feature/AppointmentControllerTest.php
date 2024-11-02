<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_store_appointment_validation()
    {
        $response = $this->postJson('/api/appointments', [
            'user_id' => '',
            'date' => '',
            'doctor' => '',
            'reason' => '',
            'status' => 'unknown',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['user_id', 'date', 'doctor', 'reason', 'status']);
    }

    public function test_store_appointment_successful_creation()
    {
        $response = $this->postJson('/api/appointments', [
            'user_id' => $this->user->id,
            'date' => now()->addDays(5)->format('Y-m-d'),
            'doctor' => 'Dr. Smith',
            'reason' => 'Routine check-up',
            'status' => 'scheduled',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'appointment']);
        $this->assertDatabaseHas('appointments', ['reason' => 'Routine check-up']);
    }

    public function test_update_appointment_validation()
    {
        $appointment = Appointment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->putJson("/api/appointments/{$appointment->id}", [
            'date' => '2020-01-01',
            'doctor' => '',
            'reason' => '',
            'status' => 'unknown',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['date', 'doctor', 'reason', 'status']);
    }

    public function test_update_appointment_successful_update()
    {
        $appointment = Appointment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->putJson("/api/appointments/{$appointment->id}", [
            'date' => now()->addDays(10)->format('Y-m-d'),
            'doctor' => 'Dr. Johnson',
            'reason' => 'Follow-up',
            'status' => 'completed',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'appointment']);
        $this->assertDatabaseHas('appointments', ['status' => 'completed']);
    }
}