<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class BlogController extends Controller
{
    //
    public function getBlog()
    {
    	$result = DB::table('categories');
    	dd($result->get());
    }

    public function getBlogWithComments()
    {
    	$result = Category::with('comments')->get();
        
        //return $result;
    	dd($result);
    }

}
