<?php

namespace App\Http\Controllers;

use App\Services\LinksService;
use Illuminate\Http\Request;

class LinkController
{
    private $linksService;

    /**
     * @param $linksService
     */
    public function __construct(LinksService $linksService)
    {
        $this->linksService = $linksService;
    }

    public function recreateNewLink(Request $request)
    {
        $this->linksService->deactivateLinkByUuid($request->uuid);
        return ($this->linksService->createGameLink($request->userId))->link;
    }

    public function deactivateLink(Request $request)
    {
        return $this->linksService->deactivateLinkByUuid($request->uuid);
    }

}
