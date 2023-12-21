<?php

namespace App\Repositories;

use App\DTO\Link\CreateLinkDTO;
use App\Models\UserLinks;

class UserLinksRepository
{
    public function createGameLink(CreateLinkDTO $createLinkDTO)
    {
        $link = new UserLinks();
        $link->fill($createLinkDTO->getDataAsArray());
        $link->save();

        return $link;
    }

    public function getAllActive()
    {
        return UserLinks::query()->where('status', 1)->get();
    }

    public function gameLinkByUserId($userId): ?UserLinks
    {
        return UserLinks::query()->where('user_id', $userId)->where('status', 1)->first();
    }

    public function getActiveByUuid($uuid)
    {
        return UserLinks::query()->where('link', $uuid)->where('status', 1)->first();
    }

    public function deactivateByUuid($uuid)
    {
        return UserLinks::query()->where('link', $uuid)->update(['status'=>false]);
    }
}
