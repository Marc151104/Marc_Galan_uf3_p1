<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'filmout'], function () {
        // Routes included with prefix "filmout"
        Route::get('/oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('/newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('/filmsByYear/{year?}', [FilmController::class, "listFilmsByYear"])->name('filmsbyYear');
        Route::get('/filmsByGenre/{genre?}', [FilmController::class, "listFilmsByGenre"])->name('filmsbyGenre');
        Route::get('/listFilms', [FilmController::class, "listFilms"])->name('listfilms');
        Route::get('/sortFilms', [FilmController::class, "sortFilms"])->name('filmssort');
        Route::get('/countFilms', [FilmController::class, "countFilms"])->name('filmscount');
    });
});

Route::middleware('urlImage')->group(function () {
    Route::group(['prefix' => 'filmin'], function () {
        // Routes included with prefix "filmin"
        Route::post('/createFilm', [FilmController::class, "createFilm"])->name('createFilm');
    });
});

    Route::group(['prefix' => 'actorout'], function () {
        // Routes included with prefix "filmin"
        Route::get('/actors', [ActorController::class, "listActors"])->name('listActors');
        Route::get('/listActorsByDecade', [ActorController::class, "listActorsDecade"])->name('listActorsDecade');
        Route::get('/countActors', [ActorController::class, "countActors"])->name('countActors');
    
    });

