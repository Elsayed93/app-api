<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use ApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (!isset($request->lang)) {
            app()->setlocale('ar');
        }


        if (isset($request->lang) && $request->lang == 'en') {
            app()->setlocale('en');
        }

        if (isset($request->lang) && $request->lang !== 'en' && $request->lang !== 'ar') {
            return $this->apiResponse(null, 'app doesn\'t support this language, please choose (ar) or (en)', 400);
        }

        return $next($request);
    }
}
