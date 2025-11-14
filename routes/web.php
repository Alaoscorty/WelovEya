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

Route::get('/direct', [ChatController::class, 'index'])->name('chat.direct');
Route::get('/messages', [ChatController::class, 'getMessages']);
Route::post('/messages', [ChatController::class, 'sendMessage']);
Route::get('/online-users', [ChatController::class, 'getOnlineCount']);


Route::get('/boutique', function () {
    return view('boutique');
})->name('boutique');

Route::get('/propos', function () {
    return view('propos');
})->name('propos');

Route::get('/formulaire', function () {
    return view('formulaire');
})->name('formulaire');

Route::get('/jeux', function () {
    return view('jeux');
})->name('jeux');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/tickets', function () {
    return view('dashboard.gestiondestickets');
})->name('tickets');

Route::get('/articles', function () {
    return view('dashboard.articles');
})->name('articles');

Route::get('/articles', function () {
    return view('dashboard.articles');
})->name('articles');

Route::get('/commandes', function () {
    return view('dashboard.commandes');
})->name('commandes');

Route::get('/ajouterrevendeur', function () {
    return view('dashboard.ajouterrevendeur');
})->name('ajouter_revendeur');


Route::get('/benefices', function () {
    return view('dashboard.');
})->name('benefices');


Route::get('/parametres', function () {
    return view('dashboard.modifierstockticket');
})->name('parametres');

Route::get('/ajouter_tickets', function () {
    return view('dashboard.ajouterstockticket');
})->name('ajouter_tickets');


