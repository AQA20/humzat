<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class BotVerifier
{
    public function isVerifiedBot(Request $request, string $expectedDomain): bool
    {
        $ip = $request->ip();

        $hostname = Cache::remember("hostname:$ip", 300, fn() => gethostbyaddr($ip));;
        if (!$hostname || !str_ends_with($hostname, $expectedDomain)) {
            return false;
        }

        // Forward DNS check to validate hostname resolves back to IP
        $resolvedIp = gethostbyname($hostname);
        return $resolvedIp === $ip;
    }
}
