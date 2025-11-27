<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\UrlShortenerService;
use Illuminate\Http\RedirectResponse;

class UrlShortenerController extends Controller
{
    /**
     * @param UrlShortenerRequest $request
     * @param UrlShortenerService $service
     * @return RedirectResponse
     */
    public function shorten(UrlShortenerRequest $request, UrlShortenerService $service): RedirectResponse
    {
        $shortUrl = $service->shorten($request->input('long_url'));
        $urlWithCode = url('/r/' . $shortUrl->code);

        return redirect()->back()->with('shortUrl', $urlWithCode);
    }

    /**
     * @param string $code
     * @param UrlShortenerService $service
     * @return RedirectResponse
     */
    public function redirect(string $code, UrlShortenerService $service): RedirectResponse
    {
        $longUrl = $service->getLongUrl($code);
        if (!$longUrl) {
            abort(404, 'Short URL not found.');
        }

        return redirect()->away($longUrl);
    }
}
