<?php

namespace App\DTO\Game;

class GameHistoryDTO
{
    protected $userId;
    protected $result;
    protected $score;
    protected $sumOfWin;

    /**
     * @param $userId
     * @param $result
     * @param $score
     * @param $sumOfWin
     */
    public function __construct($userId, $result, $score, $sumOfWin)
    {
        $this->userId = $userId;
        $this->result = $result;
        $this->score = $score;
        $this->sumOfWin = $sumOfWin;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }

    /**
     * @param mixed $sumOfWin
     */
    public function setSumOfWin($sumOfWin): void
    {
        $this->sumOfWin = $sumOfWin;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getSumOfWin()
    {
        return $this->sumOfWin;
    }

    public function getDataAsArray()
    {
        return [
            'user_id' => $this->userId,
            'result' => $this->result,
            'score' => $this->score,
            'sum_of_win' => $this->sumOfWin
        ];
    }
}
