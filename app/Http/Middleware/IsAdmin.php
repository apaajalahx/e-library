<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Level;
class IsAdmin
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
        
        $find = Level::where("users_id",Auth::user()->id);
        if($find->first()<"1"){
            return False;
        }
        if($find->first()->level_name == "admin"){
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
