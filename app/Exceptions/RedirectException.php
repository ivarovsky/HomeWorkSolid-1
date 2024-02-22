<?php 
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

class RedirectException extends Exception
{
        public function __construct($message)
        {
        parent::__construct($message, 500);
        }

	
}