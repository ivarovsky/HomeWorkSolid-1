<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\LinkMinimizer\LinkMinimizer;

use InvalidArgumentException;
use App\Exceptions\RedirectException;

use App\Exceptions\LinkValidationException;

class LinkMinimizerController extends Controller
{
public function index(Request $request)
	{
	
try {
        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
        ]);

        $validator->validate();

    		$LinkMinimizer  = new LinkMinimizer;
    		$LinkMinimizer->setLink($request->input('link'));

    		dd($LinkMinimizer->MinimizeLink());
    
    } catch (\Illuminate\Validation\ValidationException $e) 
        {
            throw new LinkValidationException($e->getMessage());
        }


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
