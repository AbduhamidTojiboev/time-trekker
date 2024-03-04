<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use App\Services\WorkLogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkLogControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/work-logs');

        $response->assertStatus(200);
        $response->assertViewIs('work-log.index');
    }
}
