<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminPanel
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
        if (is_null(auth()->user()))
            return redirect('/');

        /** @var User $user */
        $user = auth()->user();
        if ($user->isAdmin())
            return $next($request);
        else
            return redirect('/');
    }
}
