<?php


use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class EmployeeControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
        $response->assertViewIs('employee.index');
        // You can add more assertions based on your specific logic
    }

    public function testShowImport()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/employees/show-import');

        $response->assertStatus(200);
        $response->assertViewIs('employee.import');
        // You can add more assertions based on your specific logic
    }

    public function testImport()
    {
        Storage::fake('import'); // Используем фейковое хранилище для загрузок

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('employees.csv');
        $response = $this->post('/employees/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'The employees were successfully imported.');
    }

}
