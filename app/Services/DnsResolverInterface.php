<?php

namespace App\Services;

interface DnsResolverInterface
{
    public function reverseDns(string $ip): ?string;
    public function forwardDns(string $hostname): ?string;
}
