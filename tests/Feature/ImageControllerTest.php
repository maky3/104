<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест загрузки изображений.
     *
     * @return void
     */
    public function testUploadImages()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post(route('upload'), [
            'images' => [$file]
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Images uploaded successfully');

        $this->assertDatabaseHas('images', [
            'filename' => $file->hashName(),
        ]);

        Storage::disk('public')->assertExists('images/' . $file->hashName());
    }

    /**
     * Тест отображения информации об изображении.
     *
     * @return void
     */
    public function testShowImage()
    {
        $image = Image::factory()->create();

        $response = $this->get(route('images.show', $image->id));

        $response->assertStatus(200);
        $response->assertViewIs(value: 'images.show');
        $response->assertViewHas('image', function ($viewImage) use ($image) {
            return $image->id === $viewImage->id;
        });
    }
}
