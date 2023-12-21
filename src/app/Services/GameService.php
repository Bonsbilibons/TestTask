<?php

namespace App\Services;

use App\DTO\Game\GameHistoryDTO;
use App\Repositories\GameHistoryRepository;

class GameService
{
    private $gameHistoryRepository;
    private $userService;

    /**
     * @param $gameHistoryRepository
     * @param $userService
     */
    public function __construct(GameHistoryRepository $gameHistoryRepository, UserService $userService)
    {
        $this->gameHistoryRepository = $gameHistoryRepository;
        $this->userService = $userService;
    }


    public function play($uuid)
    {
        $user = $this->userService->byActiveLink($uuid);
        if(!$user)
        {
            return  ['error' => 'Wrong link'];
        }
        $score = rand(0, 1000);
        $result = !($score % 2);
        $sumOfWin = 0.0;
        if($result) {
            if($score > 900){
                $sumOfWin = ($score / 100) * 70;
            }
            else if($score > 600){
                $sumOfWin = ($score / 100) * 50;
            }
            else if($score > 300){
                $sumOfWin = ($score / 100) * 30;
            }
            else if($score <= 300){
                $sumOfWin = ($score / 100) * 10;
            }
        }

        $gameHistoryDTO = new GameHistoryDTO($user->id, $result, $score, $sumOfWin);
        $gameHistory = $this->gameHistoryRepository->create($gameHistoryDTO);
        return ([
            'result' => $gameHistory->result ? "Win" : "Lose",
            'score' => $gameHistory->score,
            'sumOfWin' => $gameHistory->sum_of_win,
        ]);
    }

    public function history($uuid)
    {
        $user = $this->userService->byActiveLink($uuid);
        return $this->gameHistoryRepository->getTheLatest($user->id, 3);
    }
}
