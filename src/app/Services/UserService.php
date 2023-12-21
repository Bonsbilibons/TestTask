<?php

namespace App\Services;


use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    /**
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function findOrCreate(UserDTO $userDTO): ?User
    {
        $user = ($this->byNumber($userDTO->getPhonenumber()));
        if(!$user)
        {
             return $this->userRepository->create($userDTO);
        }
        return $user;
    }

    public function byNumber($phoneNumber): ?User
    {
        return $this->userRepository->byNumber($phoneNumber);
    }

    public function byActiveLink($uuid): ?User
    {
        return $this->userRepository->byActiveLink($uuid);
    }

}
