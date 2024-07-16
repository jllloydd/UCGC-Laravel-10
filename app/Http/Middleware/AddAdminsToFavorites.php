<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Chatify\Facades\ChatifyMessenger as Chatify;

class AddAdminsToFavorites
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $adminUsers = User::where('usertype', 'admin')->get();
            foreach ($adminUsers as $admin) {
                if (!Chatify::inFavorite($admin->id)) {
                    Chatify::makeInFavorite($admin->id, 1);
                }
            }
        }

        return $next($request);
    }
}