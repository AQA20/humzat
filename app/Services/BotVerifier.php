<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Cache\RateLimiting\Limit;

class BotVerifier
{
    protected DnsResolverInterface $dnsResolver;

    public function __construct(DnsResolverInterface $dnsResolver)
    {
        $this->dnsResolver = $dnsResolver;
    }

    protected function isVerifiedBot(Request $request, string $expectedDomain): bool
    {
        $ip = $request->ip();

        $hostname = Cache::remember("hostname:$ip", 300, fn() => $this->dnsResolver->reverseDns($ip));
        if (!$hostname || !str_ends_with(strtolower($hostname), strtolower($expectedDomain))) {
            return false;
        }

        $resolvedIp = $this->dnsResolver->forwardDns($hostname);
        return $resolvedIp === $ip;
    }

    public function resolveBotOrTrustedLimit(Request $request): ?Limit
    {

        $trustedIps = array_filter(config('trusted.ips', []));
        if (in_array($request->ip(), $trustedIps)) {
            return Limit::none();
        }

        $bots = [
            'googlebot' => '.googlebot.com',
            'bingbot' => '.search.msn.com',
            'yandexbot' => '.yandex.ru',
            'applebot' => '.applebot.apple.com',
        ];

        $ip = $request->ip();
        $ua = strtolower($request->userAgent() ?? '');

        foreach ($bots as $keyword => $domain) {
            if (str_contains($ua, $keyword) && $this->isVerifiedBot($request, $domain)) {
                return Limit::perMinute(300)->by($ip);
            }
        }

        return null;
    }
}
