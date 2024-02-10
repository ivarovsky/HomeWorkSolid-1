<?php

namespace App\Services;

interface Coordinates
{
 public function set_coordinates($lat,$lon);
 public function distanceCalculator($lat,$lon);

}