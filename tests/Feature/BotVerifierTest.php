<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Services\BotVerifier;
use App\Services\DnsResolverInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BotVerifierTest extends TestCase
{
    use RefreshDatabase;

    protected function mockRequest(string $ip, string $userAgent): Request
    {
        $request = Request::create('/', 'GET');
        $request->server->set('REMOTE_ADDR', $ip);
        $request->headers->set('User-Agent', $userAgent);
        return $request;
    }

    public function test_trusted_ip_returns_unlimited_limit()
    {
        Config::set('trusted.ips', ['1.2.3.4']);

        $request = $this->mockRequest('1.2.3.4', 'Some User Agent');

        // DNS resolver mock with no calls expected for trusted IPs
        $dnsResolver = Mockery::mock(DnsResolverInterface::class);
        $dnsResolver->shouldNotReceive('reverseDns');
        $dnsResolver->shouldNotReceive('forwardDns');

        $verifier = new BotVerifier($dnsResolver);

        $limit = $verifier->resolveBotOrTrustedLimit($request);

        $this->assertInstanceOf(Limit::class, $limit);
        $this->assertEquals(PHP_INT_MAX, $limit->maxAttempts);
    }

    public function test_untrusted_bot_not_verified_returns_null()
    {
        Config::set('trusted.ips', []);

        // DO NOT mock Cache::remember here; let it run normally

        $request = $this->mockRequest('8.8.8.8', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');

        $dnsResolver = Mockery::mock(DnsResolverInterface::class);
        $dnsResolver->shouldReceive('reverseDns')->once()->andReturn('something.invalid.com');
        $dnsResolver->shouldReceive('forwardDns')->never();

        $verifier = new BotVerifier($dnsResolver);

        $limit = $verifier->resolveBotOrTrustedLimit($request);

        $this->assertNull($limit);
    }

    public function test_verified_bot_returns_high_limit()
    {
        Config::set('trusted.ips', []);

        // DO NOT mock Cache::remember here either

        $request = $this->mockRequest('66.249.66.1', 'Googlebot/2.1');

        $dnsResolver = Mockery::mock(DnsResolverInterface::class);
        $dnsResolver->shouldReceive('reverseDns')->once()->andReturn('crawl-66-249-66-1.googlebot.com');
        $dnsResolver->shouldReceive('forwardDns')->once()->andReturn('66.249.66.1');

        $verifier = new BotVerifier($dnsResolver);

        $limit = $verifier->resolveBotOrTrustedLimit($request);

        $this->assertInstanceOf(Limit::class, $limit);
        $this->assertEquals(300, $limit->maxAttempts);
    }

    public function test_normal_user_returns_null()
    {
        Config::set('trusted.ips', []);

        $request = $this->mockRequest('9.9.9.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        // No DNS calls expected
        $dnsResolver = Mockery::mock(DnsResolverInterface::class);
        $dnsResolver->shouldNotReceive('reverseDns');
        $dnsResolver->shouldNotReceive('forwardDns');

        $verifier = new BotVerifier($dnsResolver);

        $limit = $verifier->resolveBotOrTrustedLimit($request);

        $this->assertNull($limit);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
