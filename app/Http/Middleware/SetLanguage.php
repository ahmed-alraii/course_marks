<?php

namespace App\Http\Middleware;


;

use App\Providers\AuthServiceProvider;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ( $request->language !==  "en" && $request->language !== "ar" ) {
            $request->merge(["language" => "en"]);
            return redirect(RouteServiceProvider::HOME);
        }

        app()->setLocale($request->language);
        return $next($request);
    }
}
