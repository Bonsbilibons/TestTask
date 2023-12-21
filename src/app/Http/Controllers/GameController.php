<?php

namespace App\Http\Controllers;

use app\DTO\User\UserDTO;
use App\Services\GameService;
use Illuminate\Http\Request;

class GameController
{
    private $gameService;

    /**
     * @param $gameHistoryService
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function mainGame(Request $request, $uuid)
    {

        return view('game', [
            'uuid' => $uuid
        ]);
    }

    public function play(Request $request)
    {
        return $this->gameService->play($request->uuid);
    }

    public function history(Request $request)
    {
        return $this->gameService->history($request->uuid);
    }
}
