<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ProfileController;
use App\Models\Competition;
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
require __DIR__ . '/auth.php';
Route::get('/', function () {
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::resource('/competition', CompetitionController::class);
Route::post('/competition/subscribe', [CompetitionController::class, 'subscribe'])->name('competition.subscribe');
Route::get('/winners', [CompetitionController::class, 'winners'])->name('competition.winners');
Route::post('/cancel', [CompetitionController::class, 'cancel'])->name('competition.cancel');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

