<?php

namespace App\Http\Middleware;

use App\Models\UserProduct;
use Closure;
use Illuminate\Http\Request;

class CheckProductUserBelongsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->userProducts()->find($request->id)){
            return $next($request);
        }
        return response('не авторизован для текущего продукта', 403);

    }
}
