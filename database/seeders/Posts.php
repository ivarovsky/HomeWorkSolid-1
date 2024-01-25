<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Author;
use App\Models\Category;


class Posts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $author = Author::find(1);
        $category = Category::find(1);

                DB::table('posts')->insert([
                    'publication_date'=>now(),
            'category_id'=>$category->id,
            'author_id' => $author->id,
            'name'=>'TEST POST',
            'text' => "TEST POST TEXT"

        ]);

    }
}
