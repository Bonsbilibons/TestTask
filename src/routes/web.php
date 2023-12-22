<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;


use Illuminate\Support\Facades\Route;

Route::get('main', [MainController::class, 'mainPage'])->name('main.page');

Route::group([
    'as' => 'game.',
    'middleware' => ['active.link'],
    ],
    function ()
    {
        Route::get('game/{uuid}', [GameController::class, 'mainGame'])->name('main');
    }
);
