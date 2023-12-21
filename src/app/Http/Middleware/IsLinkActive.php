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
        }
        else
        {
            $uuid = $request->uuid;
        }
        $link = $this->linksService->getByUuid($uuid);
        if($link){
            $errors = new MessageBag();
            $errors->add('linkExpired', 'This Link is expired. You should make new one');
            if($link->status == false)
            {
                return Redirect::route('main.page')->withErrors($errors);
            }
            else if((Carbon::now() > $link->expired_at))
            {
                $this->linksService->deactivateLinkByUuid($link->link);
                return Redirect::route('main.page')->withErrors($errors);
            }
        }
        else{
            abort(404);
        }
        return $next($request);
    }
}
