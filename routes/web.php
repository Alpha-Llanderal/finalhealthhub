<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
//Common Resource Routes/Naming:
//index - Shows all date -> listings Route::get();
//show - Show single data -> listing Route::get();

//create - Show form to create new -> listing Route::post();
//store - Store Data -> new listing
//edit - Show form to edit data -> listing Route::put(); Route::patch();
//update - Update data -> listing Route::delete();
//destroy - Delete a data -> listing ROute::options()

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

