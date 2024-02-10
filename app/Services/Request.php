<?php

namespace App\Services;
 
interface Request
{
 public function set_client($client);
 public function request($method,$url);
}