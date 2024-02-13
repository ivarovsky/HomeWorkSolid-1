<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkMinimizerController extends Controller
{
    public function index(Request $request)
    	{
    		$get = $request->all();
    		if(isset($get['Link']))
    			{
    				echo md5($get['Link'])." :Mimimize";
    			}
    		else echo "Give Me Link!";
    	/*
    			1.GetLink
    			2 Check Link In DB.
    			
    			IF Exists: Return actualy link!
    			
    			Else:
    			3.Create Link Unique Signature
    			4.Add this link to DB
    	*/
    	}

    public function redirect($Link)
    {
    	echo $Link." :Redirect";

    }
}
