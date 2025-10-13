<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'category_id' => Category::query()->inRandomOrder()->value('id')
                ?? Category::factory()->create()->id,
        ];
    }
}
