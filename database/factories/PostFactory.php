<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_active' =>1,
            'category_id'=>Category::get()->random()->id,
            'author_id'=>Author::get()->random()->id,
            'name'=>fake()->name(),
            'text'=>Str::random(150)
        ];
    }
}
