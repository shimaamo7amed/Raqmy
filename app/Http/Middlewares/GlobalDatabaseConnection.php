<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class GlobalDatabaseConnection
{
    public function handle(Request $request, Closure $next)
    {
        // Add your database connection logic here
        return $next($request);
    }
}
