<?php

namespace App\Http\Middleware;

use App\Models\VisitorEvent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldTrack($request)) {
            return $response;
        }

        $geo = $this->resolveCountry($request);

        VisitorEvent::create([
            'session_id' => $request->hasSession() ? $request->session()->getId() : null,
            'ip_address' => $request->ip(),
            'country_code' => $geo['code'],
            'country_name' => $geo['name'],
            'url' => '/'.ltrim($request->path(), '/'),
            'referrer' => $request->headers->get('referer'),
            'source' => $this->resolveTrafficSource($request),
            'user_agent' => $request->userAgent(),
            'visited_at' => now(),
        ]);

        return $response;
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return false;
        }

        $path = trim($request->path(), '/');

        if (str_starts_with($path, 'storage') || str_starts_with($path, '_boost') || str_starts_with($path, 'up')) {
            return false;
        }

        $userAgent = strtolower((string) $request->userAgent());
        $botMarkers = ['bot', 'spider', 'crawler', 'slurp', 'facebookexternalhit', 'mediapartners-google'];

        foreach ($botMarkers as $marker) {
            if (str_contains($userAgent, $marker)) {
                return false;
            }
        }

        return true;
    }

    private function resolveTrafficSource(Request $request): string
    {
        $utmSource = strtolower((string) $request->query('utm_source', ''));
        $utmMedium = strtolower((string) $request->query('utm_medium', ''));
        $referrer = strtolower((string) $request->headers->get('referer', ''));

        if ($utmMedium === 'email' || str_contains($utmSource, 'mail')) {
            return 'Email';
        }

        if ($utmMedium === 'cpc' || $utmMedium === 'ppc' || str_contains($utmMedium, 'paid')) {
            return 'Paid Ads';
        }

        if ($this->containsAny($referrer, ['google.', 'bing.', 'duckduckgo.', 'yahoo.', 'baidu.', 'yandex.'])) {
            return 'Organic Search';
        }

        if ($this->containsAny($referrer, ['facebook.', 'instagram.', 'linkedin.', 'x.com', 'twitter.', 't.co', 'youtube.', 'tiktok.'])) {
            return 'Social';
        }

        if ($referrer === '') {
            return 'Direct';
        }

        return 'Referral';
    }

    private function containsAny(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_contains($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }

    private function resolveCountry(Request $request): array
    {
        $code = strtoupper((string) (
            $request->headers->get('CF-IPCountry')
            ?? $request->headers->get('X-AppEngine-Country')
            ?? $request->headers->get('X-Country-Code')
            ?? ''
        ));

        if ($code === '' || $code === 'XX' || $code === 'T1') {
            return ['code' => null, 'name' => 'Unknown'];
        }

        $name = $this->countryNameFromCode($code);

        return ['code' => $code, 'name' => $name];
    }

    private function countryNameFromCode(string $code): string
    {
        if (class_exists(\Locale::class)) {
            $name = \Locale::getDisplayRegion('-'.$code, 'en');

            if (is_string($name) && $name !== '' && ! str_starts_with($name, '-')) {
                return $name;
            }
        }

        return match ($code) {
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'AE' => 'United Arab Emirates',
            'AU' => 'Australia',
            'DE' => 'Germany',
            'CA' => 'Canada',
            'PK' => 'Pakistan',
            default => $code,
        };
    }
}

