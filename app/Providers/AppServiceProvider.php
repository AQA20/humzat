<?php

namespace App\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Services\BotVerifier;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
            $trustedIps = explode(',', env('TRUSTED_IPS'));
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
            $verifier = new BotVerifier();

            foreach ($bots as $keyword => $domain) {
                if (str_contains($ua, $keyword) && $verifier->isVerifiedBot($request, $domain)) {
                    return Limit::perMinute(300)->by($ip);
                }
            }

            return $request->user()
                ? Limit::perMinute(120)->by($request->user()->id)
                : Limit::perMinute(60)->by($request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Too many login attempts. Try again in a minute.'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                });
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perHour(3)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Too many registration attempts. Please try again in an hour.'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                });
        });

        RateLimiter::for('comment', function (Request $request) {
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
