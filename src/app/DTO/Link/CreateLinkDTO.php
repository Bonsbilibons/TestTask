<?php

namespace app\DTO\Link;

use Carbon\Carbon;

class CreateLinkDTO
{
    protected $userId;
    protected $status;
    protected $link;
    protected $expiredAt;

    /**
     * @param $userId
     * @param $status
     * @param $link
     * @param $expiredAt
     */
    public function __construct($userId, $status, $link, Carbon $expiredAt)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->link = $link;
        $this->expiredAt = $expiredAt;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @param Carbon $expiredAt
     */
    public function setExpiredAt(Carbon $expiredAt)
    {
        $this->expiredAt = $expiredAt;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return Carbon
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    public function getDataAsArray()
    {
        return [
            'user_id' => $this->userId,
            'status' => $this->status,
            'link' => $this->link,
            'expired_at' => $this->expiredAt,
        ];
    }
}
