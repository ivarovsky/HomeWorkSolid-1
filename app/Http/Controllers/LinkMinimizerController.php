<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\LinkMinimizer\LinkMinimizer;

use InvalidArgumentException;
use App\Exceptions\RedirectException;

//use App\Exceptions\LinkValidationException;

class LinkMinimizerController extends Controller
{
public function index(Request $request)
	{

    $LinkMinimizer  = new LinkMinimizer;
    $LinkMinimizer->setLink($request->input('link'));
    dd($LinkMinimizer->MinimizeLink());
	}

    public function redirect($linkSignature)
    {
    	$LinkMinimizer  = new LinkMinimizer;
    	$LinkMinimizer->setLinkSignature($linkSignature);
    	try {
            return redirect()->away($LinkMinimizer->RedirectToLink()) ?? false;

            
        } catch (InvalidArgumentException $e) 
        {
            throw new RedirectException($e->getMessage());
        }
    	


    }
}
