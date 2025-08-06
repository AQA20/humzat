<?php

namespace App\Providers;


use Illuminate\Http\Request;
use App\Services\BotVerifier;
use App\Services\PhpDnsResolver;
use Illuminate\Support\Facades\Route;
use App\Services\DnsResolverInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DnsResolverInterface::class, PhpDnsResolver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

        RateLimiter::for('api', function (Request $request) {
            $verifier = app(BotVerifier::class);
            if ($limit = $verifier->resolveBotOrTrustedLimit($request)) {
                return $limit;
            }
        });

        RateLimiter::for('login', function (Request $request) {
            $verifier = app(BotVerifier::class);
            if ($limit = $verifier->resolveBotOrTrustedLimit($request)) {
                return $limit;
            }
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Too many login attempts. Try again in a minute.'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                });
        });

        RateLimiter::for('register', function (Request $request) {
            $verifier = app(BotVerifier::class);
            if ($limit = $verifier->resolveBotOrTrustedLimit($request)) {
                return $limit;
            }
            return Limit::perHour(3)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Too many registration attempts. Please try again in an hour.'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                });
        });

        RateLimiter::for('comment', function (Request $request) {
            $verifier = app(BotVerifier::class);
            if ($limit = $verifier->resolveBotOrTrustedLimit($request)) {
                return $limit;
            }
            return Limit::perMinute(5)
                ->by($request->user()->id)
                ->response(function () {
                    return response()->json([
                        'message' => 'Too many comments. Please slow down and try again shortly.'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                });
        });
    }
}
