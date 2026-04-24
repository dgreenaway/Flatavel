<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// This middleware protects the admin routes. Middleware runs between the
// request arriving and the controller handling it -- like a checkpoint.
// I learned that $next($request) means "carry on to the controller".
// If the check fails I redirect instead of calling $next.

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the admin session flag is set. This gets written when
        // the correct password is entered on the login page.
        if (!session('admin_authed')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
