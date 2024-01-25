<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () 
{
	echo "okay";
});

Route::get('/homeWorkSolid', [App\Http\Controllers\HomeWorkSolidControllerTWO::class, 'index']);



Route::get('/homeWorkServiceContainers', [App\Http\Controllers\HomeWorkServiceContainers::class, 'index']);
