<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;


use App\Models\Author;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_active'=>1,
            'author_id'=>Author::get()->random()->id,
            'post_id'=>Post::get()->random()->id,
            'text'=>fake()->name()
        ];
    }
}
/*
table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('author_id')->foreign('author_id')->references('id')->on('authors');
            $table->unsignedBigInteger('post_id')->foreign('post_id')->references('id')->on('posts');
            $table->text('text',512);
*/