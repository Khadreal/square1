<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 
 */
class RoleAccess
{
	/**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @param null                     $guard
     *
     * @throws \Exception
     * @return mixed
     */
    public function handle( $request, Closure $next, $guard = null )
    {
        $roles = explode( '|', $guard );
        foreach ( $roles as $role ) {
            if( \App\Square1\RoleAccess::hasAccess( $request->user()->role, $role ) ) {
                return $next($request);
            }
        }
        
        return abort( 401, 'Access denied.' );
    }
}