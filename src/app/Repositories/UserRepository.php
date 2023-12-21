<?php

namespace App\Repositories;

use App\DTO\User\UserDTO;
use App\Models\User;

class UserRepository
{
    public function byNumber($phoneNumber): ?User
    {
        return User::query()->where('phonenumber', $phoneNumber)->first();
    }

    public function byActiveLink($uuid): ?User
    {
        return User::query()
            ->whereHas('links', function ($query) use ($uuid) {
                $query->where('link', $uuid)->where('status', true);
            })
            ->first();
    }

    public function create(UserDTO $userDTO)
    {
        $user = new User();
        $user->fill($userDTO->getDataAsArray());
        $user->save();

        return $user;
    }
}
