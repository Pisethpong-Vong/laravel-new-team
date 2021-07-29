<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class QueryLog
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
        DB::connection()->enableQueryLog();
        $response = $next($request);

        // Perform action
        $queries = DB::getQueryLog();

        Log::channel('sql')->info(["url" => $request->path(), $queries]);

        return $response;
    }
}
