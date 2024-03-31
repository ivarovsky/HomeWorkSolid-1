<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Factory;

class DBFactorySeeder extends Seeder
{
    public function run()
    {
        // Створення категорій
        Category::factory()->count(1000)->create()->each(function ($category) {
            // Створення постів для кожної категорії
            $category->posts()->saveMany(Post::factory()->count(10)->make()->each(function ($post) {
                // Створення коментарів для кожного поста
                $post->comments()->saveMany(Comment::factory()->count(5)->make());
            }));
        });
    }
}