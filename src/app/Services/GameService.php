<?php

namespace App\Services;

use App\DTO\Game\GameHistoryDTO;
use App\Models\User;
use App\Repositories\GameHistoryRepository;
use PhpParser\Node\Stmt\Switch_;

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


    public function play(User $user): array
    {
        $score = rand(0, 1000);
        $result = !($score % 2);
        $sumOfWin = 0;

        if ($result) {
            $percent = 10;
            if ($score > 300) {
                $percent = 30;
            }
            if ($score > 600) {
                $percent = 50;
            }
            if ($score > 900) {
                $percent = 70;
            }
            $sumOfWin = ($score / 100) * $percent;
        }

        $gameHistoryDTO = new GameHistoryDTO($user->id, $result, $score, $sumOfWin);
        $gameHistory = $this->gameHistoryRepository->create($gameHistoryDTO);

        return [
            'status' => 'success',
            'data' => [
                'result' => $gameHistory->result ? "Win" : "Lose",
                'score' => $gameHistory->score,
                'sumOfWin' => $gameHistory->sum_of_win,
            ]
        ];
    }

    public function history($uuid): array
    {
        $user = $this->userService->byActiveLink($uuid);
        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'Wrong Link',
            ];
        }
        return [
            'status' => 'success',
            'data' => $this->gameHistoryRepository->getTheLatest($user->id, 3),
        ];
    }
}
