<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! getLoggedInUser()->status) {
            auth()->logout();
            Flash::error('Your account has been deactivated.');

            return redirect('login');
        }

        return $next($request);
    }
}
