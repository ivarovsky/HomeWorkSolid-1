<?php 
namespace App\Map;

use GuzzleHttp\Client as GuzzleClient;

class MapFinder extends GuzzleClient implements Map  
{
	private $url='https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
	private $search;
    private $lat;
    private $lon;
    private $properties;
    private $exclude_place_ids;
    private $places;

	public function setUrl($u)
		{
			$this->url = $u;
			return $this;
		}
	public function setSearch($s)
		{
			$this->search = $s;
			return $this;
		}
	public function setCoordinate($lat,$lon)
		{
			$this->lat = $lat;
			$this->lon = $lon;
			return $this;
		}
	public function setProperties(array $properties)
		{
			$this->properties = $properties;
			return $this;
		}
	private function distanceCalculator()
		{
		foreach ($this->places as $place)
			{
	            $res = 2 * asin(sqrt(pow(sin(($this->lat - $place->lat) / 2), 2) + cos($this->lat) * cos($place->lat) * pow(sin(($this->lon - $place->lon) / 2), 2)));
	            $place->distance = $res;
	        }
		}
	private function SortByDistance()
		{
			usort($this->places, function($a, $b){
            return ($a->distance < $b->distance) ? -1 : 1;
        	});
		}
	private function SetExludePlaces()
		{
			$this->exclude_place_ids='&exclude_place_ids=' . urlencode(implode(',', array_keys($this->places)));
		}
	private function FilterKeys()
		{
	        $this->places = array_map(
	        		function ($place) 
	        				{
	        				$filtered = (object)array_intersect_key((array)$place, array_flip($this->properties));
	        				$this->places[$place->place_id] = $filtered;
	        				return $filtered;
	    					}, 
	    	$this->places);
	    	$this->places = array_combine(array_keys($this->places), array_values($this->places));
		}
	public function search()
	{
		$response = parent::request('GET', $this->url . urlencode($this->search) . $this->exclude_place_ids);
        $this->places = json_decode($response->getBody()->getContents());
		if(count($this->places))
		{
		$this->distanceCalculator();
		$this->SortByDistance();
		$this->FilterKeys();
		$this->SetExludePlaces();
		return $this->places;
		}
	}
}