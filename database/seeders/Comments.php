<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Author;

class Comments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$author = Author::find(1);

        DB::table('comments')->insert([
            'text' => "TEST Comment",
            'author_id' => $author->id,

        ]);
    }
}
