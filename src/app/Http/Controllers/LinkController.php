<?php

namespace App\Http\Controllers;

use App\Services\LinksService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class LinkController
{
    private $linksService;
    private $userService;

    /**
     * @param $linksService
     * @param $userService
     */
    public function __construct(LinksService $linksService, UserService $userService)
    {
        $this->linksService = $linksService;
        $this->userService = $userService;
    }

    /**
     * @param $linksService
     */


    public function createNewLink(Request $request): array
    {
        $user = $this->userService->byActiveLink($request->uuid);
        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'User not found'
            ];
        }
        $linkUuid = $this->linksService->createGameLink($user->id)->link;
        return [
            'status' => 'success',
            'data' => ['link' => route('game.main', $linkUuid)]
        ];
    }

    public function deactivateLink($uuid)
    {
        if ($this->linksService->deactivateLinkByUuid($uuid)) {
            return redirect()->route('main.page');
        }
        return redirect()->back();
    }

}
