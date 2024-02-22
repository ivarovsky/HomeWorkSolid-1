<?php

namespace App\Services;

interface Map 
{
	public function search();
	public function setProperties(array $properties);
	public function setSearch($search);
	public function setUrl($url);
	public function setCoordinatesCalculator($calculator);
	public function setRequestClient($client);
}