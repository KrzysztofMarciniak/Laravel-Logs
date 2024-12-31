<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DataMine;
use App\Models\DataMined;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(Datamine::class);

Route::get('/data', function () {
	$data = DataMined::all();
	$columns = (new DataMined())->getFillable();
	return view('data.index', ['data' => $data, 'columns'=> $columns]);
	
});