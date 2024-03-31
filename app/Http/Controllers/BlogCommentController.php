<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;




class BlogCommentController extends Controller
{
    //
    public function deleteComment(Request $data)
    {
    	$get = $data->all();
    	DB::table('comments')->where('id', $get['id'])->delete();
    
    	dd(DB::table('comments')->get());
    }

    public function createComment(Request $data)
    {

	$get = $data->all();

	DB::transaction(function () use ($get) {
    // Створіть новий коментар
    $comment = Comment::create([
        'is_active' => 1,
        'author_id' => $get['author_id'],
        'post_id' => $get['postId'],
        'text' => $get['text']
    ]);
    //

    // Оновіть час останнього оновлення для коментаря
    $comment->touch();

    // Отримайте пост, до якого додано коментар
    $post = Post::find($get['postId']);


    // Оновіть час останнього оновлення для посту
    $post->touch();
    //dd($post);
    dd($comment);
});
    }


}
