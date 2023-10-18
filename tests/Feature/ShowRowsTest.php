<?php

namespace Tests\Feature;

use App\Models\Row;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowRowsTest extends TestCase
{

    public function testControllerMethod(): void
    {
        $row = Row::all()->random();
        $response = $this->get('/show');
        $response->assertStatus(200)
            ->assertJson([
                $row->date => [],
            ]);
    }
}
