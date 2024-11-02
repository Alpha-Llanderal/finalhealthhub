<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseSeedingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_users_table_has_records()
{
    $this->assertGreaterThan(0, \App\Models\User::count());
}

public function test_appointments_table_links_to_users()
{
    $appointment = \App\Models\Appointment::first();
    dd([
        'appointment' => $appointment->toArray(),
        'user_id' => $appointment->user_id,
        'user_exists' => \App\Models\User::find($appointment->user_id)
    ]);
    $this->assertNotNull($appointment->user);
}

}
