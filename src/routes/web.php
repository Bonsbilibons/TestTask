<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('main', [MainController::class, 'mainPage'])->name('main.page');

Route::post('register', [UserController::class, 'register'])->name('register');

Route::group([
    'as' => 'game.',
    'middleware' => ['active.link'],
    ],
    function ()
    {
        Route::get('game/{uuid}', [GameController::class, 'mainGame'])->name('main');
        Route::post('game/play', [GameController::class, 'play'])->name('play');
        Route::post('game/history', [GameController::class, 'history'])->name('history');
    }
);



Route::group([
    'as' => 'link.',
    ],
    function ()
    {
        Route::post('recreate-link', [LinkController::class, 'recreateNewLink'])->name('recreate');
        Route::post('deactivate-link', [LinkController::class, 'deactivateLink'])->name('deactivate');
    }
);
