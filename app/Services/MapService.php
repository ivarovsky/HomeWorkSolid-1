<?php

namespace App\Services;

/**
 * Class Map.
 */
class MapService implements Map
{
	private $url;
	private $request_client;
	private $search;

    private $coordinates_calculator;
    private $properties;
    private array $exclude_place_ids;
    private $places;

     public function setRequestClient($client)
    	{
    		$this->request_client = $client;
    		return $this;
    	}

    public function setCoordinatesCalculator($calculator)
    	{
    		$this->coordinates_calculator = $calculator;
    		return $this;
    	}

	public function setUrl($url)
		{
			$this->url = $url;
			return $this;
		}
	public function setSearch($search)
		{
			$this->search = $search;
			$this->exclude_place_ids = ($this->search == $search) ? [] : $this->exclude_place_ids;

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
	            $place->distance = $this->coordinates_calculator->distanceCalculator($place->lat,$place->lon);
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
			if(!isset($this->exclude_place_ids)) $this->exclude_place_ids = array_keys($this->places);
			else $this->exclude_place_ids=array_merge($this->exclude_place_ids, array_keys($this->places));
		
		}
	private function FilterKeys()
		{
		    $this->places = array_map(
		        function ($place) {
		            $filtered = (object) array_intersect_key((array) $place, array_flip($this->properties));
		            return $filtered;
		        },
		        $this->places
		    );

		    $this->places = array_combine(array_column($this->places, 'place_id'), $this->places);
		}
		private function getUrl()
		{
			$result = $this->url . urlencode($this->search);
			if(isset($this->exclude_place_ids)) $result .= '&exclude_place_ids=' .urlencode(implode(',', $this->exclude_place_ids)) ;
			return $result;
		}

	public function search()
	{
		$response = $this->request_client->request('GET', $this->getUrl());
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
