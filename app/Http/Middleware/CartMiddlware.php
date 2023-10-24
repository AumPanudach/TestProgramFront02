<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartMiddlware
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
        $qty = $request->route()->parameters()['qty'];
        if(!is_numeric($qty)) {
        return response('Invalid request', 400);
        }
        return $next($request);
    }
}
