<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if(checkPermissionbyRoleID(\Auth::user()->role_id, $permission)){
            return $next($request);
        }else{
            $data['class'] = 'danger';
            $data['message'] = 'You do not have permissions to access this page.';
            return redirect('dashboard')->with($data);
        }
    }
}
