<?php 
namespace App\Coordinates;
class CoordinatesCalculator implements Coordinates 
	{
		
		public function distanceCalculator(array $start = ["lat"=>0,"lon"=>0],array $end = ["lat"=>0,"lon"=>0])
			{
				return 2 * asin(sqrt(pow(sin(($start['lat'] - $end['lat']) / 2), 2) + cos($start['lat']) * cos($end['lat']) * pow(sin(($start['lon'] - $end['lon']) / 2), 2)));
			}
	}