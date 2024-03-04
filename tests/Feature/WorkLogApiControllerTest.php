<?php


use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkLogApiControllerTest extends TestCase
{
    public function testStartWorkLogSuccess()
    {
        // Assuming you have an employee record in the database
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/work-log/start', ['employee_id' => $employee->id]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Successfully launched tracker']);

        // You can add more assertions as needed
    }
    public function testStartWorkLogFailed()
    {
        // Assuming you have an employee record in the database
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/work-log/start', ['employee_id' => $employee->id]);
        $response = $this->actingAs($user)->postJson('/api/work-log/start', ['employee_id' => $employee->id]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'The tracker was previously running, first stop the tracker']);

        // You can add more assertions as needed
    }

    public function testStopWorkLogSuccess()
    {
        // Assuming you have an employee record in the database
        $employee = Employee::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)->postJson('/api/work-log/start', ['employee_id' => $employee->id]);
        $response = $this->actingAs($user)->postJson('/api/work-log/stop', ['employee_id' => $employee->id]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Tracker stopped successfully']);

        // You can add more assertions as needed
    }

    public function testStopWorkLogFailed()
    {
        // Assuming you have an employee record in the database
        $employee = Employee::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/work-log/stop', ['employee_id' => $employee->id]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'First, launch the tracker']);

        // You can add more assertions as needed
    }
}
