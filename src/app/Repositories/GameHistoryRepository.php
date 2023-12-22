<?php

namespace App\Repositories;

use App\DTO\Game\GameHistoryDTO;
use App\Models\GameHistory;

class GameHistoryRepository
{
    public function create(GameHistoryDTO $gameHistoryDTO): ?GameHistory
    {
        $gameHistory = new GameHistory();
        $gameHistory->fill($gameHistoryDTO->getDataAsArray());
        $gameHistory->save();

        return $gameHistory;
    }

    public function getTheLatest($userID, $count)
    {
        return GameHistory::query()
            ->where('user_id', $userID)
            ->orderby('created_at', 'desc')
            ->take($count)
            ->get();
    }
}
