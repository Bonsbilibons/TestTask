<?php

namespace App\Services;

use App\DTO\Link\CreateLinkDTO;
use app\DTO\User\UserDTO;
use App\Models\UserLink;
use App\Repositories\UserLinksRepository;

use Carbon\Carbon;
use http\Client\Curl\User;
use Ramsey\Uuid\Uuid;

class LinksService
{
    private $userLinkRepository;

    /**
     * @param $userLinkRepositoryl
     */
    public function __construct(UserLinksRepository $userLinkRepository)
    {
        $this->userLinkRepository = $userLinkRepository;
    }

    public function getActiveByUuid($uuid): ?UserLink
    {
        return $this->userLinkRepository->getActiveByUuid($uuid);
    }
    public function getAllExpired(): array
    {
        return $this->userLinkRepository->getAllExpired();
    }

    public function getOrCreateGameLink($userId): ?UserLink
    {
        $link = ($this->gameLinkByUserId($userId));
        if(!$link)
        {
            return $this->createGameLink($userId);
        }
        return $link;
    }

    public function createGameLink($userId): ?UserLink
    {
        $createLinkDTO = new CreateLinkDTO($userId, true, Uuid::uuid4()->toString(), Carbon::now()->addDay(7));
        return $this->userLinkRepository->createGameLink($createLinkDTO);
    }

    public function deactivateLinkByUuid($uuid): int
    {
        return $this->userLinkRepository->deactivateByUuid($uuid);
    }

    public function gameLinkByUserId($userId): ?UserLink
    {
        return $this->userLinkRepository->gameLinkByUserId($userId);
    }

    public function getAllActive(): array
    {
        return $this->userLinkRepository->getAllActive();
    }

}
