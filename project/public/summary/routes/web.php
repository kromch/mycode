<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\summaryController;
use App\Http\Requests\summaryRequest;


Route::get('/', function () {
 	if(!Session::has('is_load')) {
	$createTableSqlString='CREATE TABLE IF NOT EXISTS auth_users (id int unsigned auto_increment,login varchar(30) not null, password varchar(30) not null, primary key(id,login)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
	DB::statement($createTableSqlString);
	$login='';
	Session::flush();
	View::share('login',$login);
	Session::put('is_load','true');
	}
	Session::put('portfolio','true');		
	return view('home');
})->name('home');;
Route::get('/about', function () {
	Session::put('portfolio','true');
    return view('about');
})->name('about');
Route::get('/contacts', function () {
	Session::put('portfolio','true');
    return view('contacts');
})->name('contacts');
Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::post('/login',[summaryController::class,'login']);
Route::post('/logout',[summaryController::class,'logout']);
Route::post('/add',[summaryController::class,'addrec']);
Route::post('/delete',[summaryController::class,'deleterec']);
Route::post('/select',[summaryController::class,'selectrec']);