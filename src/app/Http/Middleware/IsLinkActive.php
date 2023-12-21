<?php

namespace App\Http\Middleware;

use App\Services\LinksService;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

class IsLinkActive
{
    private $linksService;

    /**
     * @param $linksService
     */
    public function __construct(LinksService $linksService)
    {
        $this->linksService = $linksService;
    }

    public function handle(Request $request, Closure $next)
    {
        $uuid = null;
        if($request->method() == 'GET')
        {
            $uuid = $request->route('uuid');
        } else {
            $uuid = $request->uuid;
        }
        $link = $this->linksService->getActiveByUuid($uuid);
        if(!$link){
            throw new NotFoundHttpException();
        }

        return $next($request);
    }
}
