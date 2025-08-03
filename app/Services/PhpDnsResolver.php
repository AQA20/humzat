<?php

namespace App\Services;

class PhpDnsResolver implements DnsResolverInterface
{
    public function reverseDns(string $ip): ?string
    {
        return gethostbyaddr($ip) ?: null;
    }

    public function forwardDns(string $hostname): ?string
    {
        return gethostbyname($hostname) ?: null;
    }
}
