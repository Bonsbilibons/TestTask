<?php

namespace App\Http\Controllers;

use app\DTO\User\UserDTO;
use App\Services\GameService;
use App\Services\UserService;
use Illuminate\Http\Request;

class GameController
{
    private $gameService;
    private $userService;
    /**
     * @param $gameService
     * @param $userService
     */public function __construct(GameService $gameService,UserService $userService)
    {
        $this->gameService = $gameService;
        $this->userService = $userService;
    }



    public function mainGame(Request $request, $uuid)
    {
        return view('game', [
            'uuid' => $uuid,
            'user' => $this->userService->byActiveLink($uuid),
        ]);
    }

    public function play(Request $request)
    {
        $user = $this->userService->byActiveLink($request->uuid);
        if(!$user)
        {
            return  ['error' => 'Wrong link'];
        }
        return $this->gameService->play($user);
    }

    public function history(Request $request): array
    {
        return $this->gameService->history($request->uuid);
    }
}
