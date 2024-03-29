<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\OwnProfileController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/league', [LeagueController::class, 'show'])->name('league');

Route::get('/league/{league}', [LeagueController::class, 'showLeague'])->name('league.league');

Route::get('/players', [PlayersController::class, 'show'])->name('players');

Route::get('/team-profile/{id}', [OwnProfileController::class, 'showTeam'])->name('team.profile.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/own/profile', [OwnProfileController::class, 'show'])->name('own.profile.view');
    Route::get('/player/profile/{id}', [OwnProfileController::class, 'showPlayer'])->name('player.profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
