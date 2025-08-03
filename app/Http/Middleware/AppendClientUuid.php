<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppendClientUuid
{
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->header('X-Client-UUID') ?? (string) Str::uuid();
        $request->merge(['client_uuid' => $uuid]);

        return $next($request);
    }
}
