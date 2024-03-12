<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Определение модели, для которой создается фабрика.
     *
     * @var string
     */
    protected $model = \App\Models\Image::class;

    /**
     * Определение состояния по умолчанию для модели.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filename' => $this->faker->unique()->word . '.jpg',
            'uploaded_at' => now(),
        ];
    }
}
