<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileImportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('test.xlsx');

        $response = $this->actingAs($user)->post('/importExcelFile', [
            'file' => $file,
        ]);

        Storage::assertExists('import/' . $file->hashName());
        Storage::delete('import/' . $file->hashName());
    }
}
