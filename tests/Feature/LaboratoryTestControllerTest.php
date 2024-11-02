<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\LaboratoryTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaboratoryTestControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_store_laboratory_test_validation()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/api/laboratory-tests', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['labTestName', 'fileURL']);
    }

    public function test_store_laboratory_test_successful_creation()
    {
        $this->actingAs($this->user);

        $data = [
            'labTestName' => 'Blood Test',
            'fileURL' => 'http://example.com/test.pdf'
        ];

        $response = $this->postJson('/api/laboratory-tests', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user_id',
                'labTestName',
                'fileURL',
                'created_at',
                'updated_at'
            ])
            ->assertJson([
                'user_id' => $this->user->id,
                'labTestName' => $data['labTestName'],
                'fileURL' => $data['fileURL']
            ]);
    }

    public function test_update_laboratory_test_validation()
    {
        $this->actingAs($this->user);

        $labTest = LaboratoryTest::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->putJson("/api/laboratory-tests/{$labTest->id}", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['labTestName', 'fileURL']);
    }

    public function test_update_laboratory_test_successful_update()
    {
        $this->actingAs($this->user);

        $labTest = LaboratoryTest::factory()->create([
            'user_id' => $this->user->id
        ]);

        $updateData = [
            'labTestName' => 'Updated Test',
            'fileURL' => 'http://example.com/updated.pdf'
        ];

        $response = $this->putJson("/api/laboratory-tests/{$labTest->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $labTest->id,
                'user_id' => $this->user->id,
                'labTestName' => $updateData['labTestName'],
                'fileURL' => $updateData['fileURL']
            ]);
    }
}