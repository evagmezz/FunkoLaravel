<?php

namespace Database\Factories;

use App\Models\Funko;
use Illuminate\Database\Eloquent\Factories\Factory;

class FunkoFactory extends Factory
{
    protected $model = Funko::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(640, 480, 'funko', true),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
