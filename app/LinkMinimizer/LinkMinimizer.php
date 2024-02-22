<?php 
namespace App\LinkMinimizer;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;


use App\Exceptions\SetLinkException;



use App\Exceptions\GetLinkException;

use Illuminate\Support\Facades\Redirect;

/*ТЕСТ*/
use Illuminate\Database\QueryException;
/*ТЕСТ*/


class LinkMinimizer
{
	private $link;
	private $linkSignature;
	private $linkToRedirect;

    public function setLink($link)
    {
        $this->link = $link;
    }
    
	public function setLinkSignature($linkSignature)
	{
		$this->linkSignature = $linkSignature;
	}

	private function makeLinkSignature()
	{
		$this->linkSignature = substr(md5($this->link), 0, ceil(strlen($this->link) / 2));
	}

	public function MinimizeLink()
	{
		$this->makeLinkSignature();

	    $data = [
        'link' => $this->link,
        'signature' => $this->linkSignature,
        'created_at' => now(),
        'updated_at' => now(),
    	];
    
    try {
    DB::table('LinkMinimizer')->insert($data);
    
    $this->linkToRedirect = Request::getHost().':8000/'.$this->linkSignature;
    return $this->linkToRedirect;
} catch (QueryException $e) 
	{
    throw new SetLinkException($e->getMessage());
	}


	}

	public function RedirectToLink()
	{

		try {
					$this->link=DB::table('LinkMinimizer')
    					->select('LinkMinimizer.link')
    					->where('LinkMinimizer.signature', $this->linkSignature)->first();
					
		} catch (QueryException $e) {
			throw new GetLinkException($e->getMessage());
			
		}

		return $this->link->link ?? false;
	}

}
