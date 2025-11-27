<?php

namespace App\Services;

use App\Models\ShortUrl;
use Illuminate\Support\Str;

class UrlShortenerService
{
    public const CODE_LENGTH = 6;

    /**
     * @param string $longUrl
     * @return ShortUrl
     */
    public function shorten(string $longUrl): ShortUrl
    {
        do {
            $code = Str::random(self::CODE_LENGTH);
        } while (ShortUrl::where('code', $code)->exists());

        return ShortUrl::create([
            'code' => $code,
            'long_url' => $longUrl,
        ]);
    }

    /**
     * @param string $code
     * @return string|null
     */
    public function getLongUrl(string $code): ?string
    {
        $shortUrl = ShortUrl::where('code', $code)->first();

        return $shortUrl ? $shortUrl->long_url : null;
    }
}
