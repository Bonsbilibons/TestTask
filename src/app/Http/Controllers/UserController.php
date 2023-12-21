<?php

namespace App\Http\Controllers;
use App\Services\LinksService;
use Illuminate\Http\Request;


use App\DTO\User\UserDTO;
use App\Services\UserService;

class UserController
{
    private $userService;
    private $linksService;

    /**
     * @param $userService
     * @param $linksService
     */
    public function __construct(UserService $userService, LinksService $linksService)
    {
        $this->userService = $userService;
        $this->linksService = $linksService;
    }


    public function register(Request $request)
    {
        $userDTO = new UserDTO($request->username, $request->phonenumber);
        $user = $this->userService->findOrCreate($userDTO);
        $link = $this->linksService->getOrCreateGameLink($user->id);
        return ([
            'link' => $link,
            'user' => $user,
        ]);
    }
}
