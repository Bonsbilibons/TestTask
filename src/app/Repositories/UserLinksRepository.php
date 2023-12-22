<?php

namespace App\Repositories;

use App\DTO\Link\CreateLinkDTO;
use App\Models\UserLink;
use Carbon\Carbon;

class UserLinksRepository
{
    public function createGameLink(CreateLinkDTO $createLinkDTO): ?UserLink
    {
        $link = new UserLink();
        $link->fill($createLinkDTO->getDataAsArray());
        $link->save();

        return $link;
    }

    public function getAllActive(): array
    {
        return UserLink::query()
            ->where('status', UserLink::STATUS_ACTIVE)
            ->get();
    }
    public function getAllExpired(): array
    {
        return UserLink::query()
            ->where('status', UserLink::STATUS_ACTIVE)
            ->where('expired_at', '<', Carbon::now())
            ->get();
    }

    public function gameLinkByUserId($userId): ?UserLink
    {
        return UserLink::query()
            ->where('user_id', $userId)
            ->where('status', UserLink::STATUS_ACTIVE)
            ->first();
    }

    public function getActiveByUuid($uuid): ?UserLink
    {
        return UserLink::query()
            ->where('link', $uuid)
            ->where('status', UserLink::STATUS_ACTIVE)
            ->first();
    }

    public function deactivateByUuid($uuid): int
    {
        return UserLink::query()
            ->where('link', $uuid)
            ->update(['status' => UserLink::STATUS_INACTIVE]);
    }
}
