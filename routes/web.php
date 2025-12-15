<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\PlainteController;
use App\Http\Controllers\RevendeurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\JeuxController;




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

Route::get('/billets', function () {
    return view('dashboard.billets');
})->name('billets streaming');

Route::get('/articles', function () {
    return view('dashboard.articles');
})->name('articles');

Route::get('/ajoutArticles', function () {
    return view('dashboard.ajoutArticles');
})->name('ajoutArticles');

Route::get('/gestion_variantes', function () {
    return view('dashboard.gestionVariantes');
})->name('gestion_variantes');

Route::get('/gestionCasquette', function () {
    return view('dashboard.gestionCasquette');
})->name('gestionCasquette');

Route::get('/gestionSac', function () {
    return view('dashboard.gestionSac');
})->name('gestionSac');

Route::get('/ajout_variantes', function () {
    return view('dashboard.ajoutVariantes');
})->name('ajout_variantes');

Route::get('/commandes', function () {
    return view('dashboard.commandes');
})->name('commandes');

Route::get('/detailcommande', function () {
    return view('dashboard.detailcommande');
})->name('commandes_detail');

Route::get('/intervenants', function () {
    return view('dashboard.intervenants');
})->name('intervenants');

Route::get('/ajouter_intervenants', function () {
    return view('dashboard.ajouterintervenants');
})->name('ajouter_intervenants');

Route::get('/detailIntervenant', function () {
    return view('dashboard.detailIntervenant');
})->name('detailIntervenant');

Route::get('/jeux', function () {
    return view('dashboard.Jeux');
})->name('Jeux_concours');

Route::get('/jeux', [JeuxController::class, 'index'])->name('Jeux_concours');


Route::get('/activites', function () {
    return view('dashboard.activites');
})->name('activités');

Route::get('/newAction', function () {
    return view('dashboard.newAction');
})->name('newAction');

Route::get('/plaintes', function () {
    return view('dashboard.plaintes');
})->name('plaintes');

Route::get('/revendeurs', function () {
    return view('dashboard.revendeur');
})->name('revendeurs');

Route::get('/ajouterrevendeur', function () {
    return view('dashboard.ajouterrevendeur');
})->name('ajouter_revendeur');

Route::get('/benefices', function () {
    return view('dashboard.benefices');
})->name('benefices');

Route::get('/parametres', function () {
    return view('dashboard.parametres');
})->name('parametres');

Route::get('/ajouter_tickets', function () {
    return view('dashboard.ajouterstockticket');
})->name('ajouter_tickets');

Route::post('/resellers', [ResellerController::class, 'store'])->name('resellers.store');
Route::get('/resellers', [ResellerController::class, 'index'])->name('resellers.index'); // Pour redirection après création
Route::post('/actions', [ActionController::class, 'store'])
    ->name('actions.store');
Route::get('/activites', [ActionController::class, 'index'])
    ->name('dashboard.activites');


Route::get('/dashboard/actions/{action}/edit', [ActionController::class, 'edit'])
    ->name('actions.edit');

Route::get('/dashboard/actions/{action}', [ActionController::class, 'show'])
    ->name('actions.show');

Route::put('/dashboard/actions/{action}', [ActionController::class, 'update'])
    ->name('actions.update');


Route::get('/ajout-jeux', [JeuxController::class, 'create'])->name('ajout_jeux'); // Formulaire
Route::post('/ajout-jeux', [JeuxController::class, 'store'])->name('ajout_jeux.store'); // Soumission
Route::get('/suivi-jeux', [JeuxController::class, 'index'])->name('suivi_jeux'); // Liste des jeux

// Routes pour la gestion des jeux
// Liste des jeux
Route::get('/suivi-jeux', [JeuxController::class, 'index'])->name('suivi_jeux');

// Création d'un jeu
Route::get('/ajout-jeux', [JeuxController::class, 'create'])->name('ajout_jeux');
Route::post('/ajout-jeux', [JeuxController::class, 'store'])->name('ajout_jeux.store');

// Edition d'un jeu
Route::get('/ajout-jeux/{jeu}/edit', [JeuxController::class, 'edit'])->name('ajout_jeux.edit');
Route::put('/ajout-jeux/{jeu}', [JeuxController::class, 'update'])->name('ajout_jeux.update');

// Suppression d'un jeu
Route::delete('/ajout-jeux/{jeu}', [JeuxController::class, 'destroy'])->name('ajout_jeux.destroy');

