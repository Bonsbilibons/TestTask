<?php

namespace App\Services;

use App\DTO\Link\CreateLinkDTO;
use App\Models\UserLinks;
use App\Repositories\UserLinksRepository;

use Carbon\Carbon;
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

    public function getOrCreateGameLink($userId)
    {
        $link = ($this->gameLinkByUserId($userId));
        if(!$link)
        {
            return $this->createGameLink($userId);
        }
        return $link;
    }

    public function createGameLink($userId)
    {
        $createLinkDTO = new CreateLinkDTO($userId, true, Uuid::uuid4()->toString(), Carbon::now()->addDay(7));
        return $this->userLinkRepository->createGameLink($createLinkDTO);
    }

    public function deactivateLinkByUuid($uuid)
    {
        return $this->userLinkRepository->deactivateByUuid($uuid);
    }

    public function gameLinkByUserId($userId): ?UserLinks
    {
        return $this->userLinkRepository->gameLinkByUserId($userId);
    }

    public function deactivateByUuid($uuid)
    {
        $this->userLinkRepository->deactivateByUuid($uuid);
    }

    public function getAllActive()
    {
        return $this->userLinkRepository->getAllActive();
    }

}
