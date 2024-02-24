<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Exceptions\LinkValidationException;

class ValidateLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    	try {
        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
        ]);

        $validator->validate();
        return $next($request);
    } catch (\Illuminate\Validation\ValidationException $e) 
        {
            throw new LinkValidationException($e->getMessage());
        }



        
    }
}
