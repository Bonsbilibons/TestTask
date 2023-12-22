<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [UserController::class, 'register'])->name('register');

Route::group([
    'as' => 'game.',
    'middleware' => ['active.link'],
],
    function ()
    {
        Route::post('game/play', [GameController::class, 'play'])->name('play');
        Route::post('game/history', [GameController::class, 'history'])->name('history');
    }
);

Route::group([
    'as' => 'link.',
],
    function ()
    {
        Route::post('create-link', [LinkController::class, 'createNewLink'])->name('create');
        Route::get('deactivate-link/{uuid}', [LinkController::class, 'deactivateLink'])->name('deactivate');
    }
);
