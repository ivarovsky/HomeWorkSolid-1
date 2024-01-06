<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

use App\Map\Map;
use App\Map\MapFinder;

class HomeWorkSolidControllerTWO extends Controller
{
    public function index(Request $request)
    {
        
     	$find = new MapFinder;
        $find->setSearch('Продукти Одеса')->setCoordinate(46.4774700,30.7326200)->setProperties(['place_id', 'name', 'display_name', 'distance']);

        $places=$find->search();
        dump($places);
     
     	$places=$find->search();
        dump($places);
    }
}
