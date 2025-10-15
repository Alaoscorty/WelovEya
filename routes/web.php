<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/artistes', function () {
    return view('artistes');
})->name('artistes');

Route::get('/billeterie', function () {
    return view('billeterie');
})->name('billeterie');

Route::get('/direct',[ChatController::class,'index'])->name ('direct');
Route::post('/send',[ChatController::class, 'send'])->name ('chat.send');


Route::get('/produit', function () {
    return view('produit');
})->name('produit');

Route::get('/propos', function () {
    return view('propos');
})->name('propos');

Route::get('/jeux', function () {
    return view('jeux');
})->name('jeux');
