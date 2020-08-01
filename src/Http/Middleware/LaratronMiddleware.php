<?php

declare(strict_types=1);

namespace Sandulat\Laratron\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\Response;

final class LaratronMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $crawlerDetect = new CrawlerDetect;

        if ($crawlerDetect->isCrawler() && $crawlerDetect->getMatches() !== 'HeadlessChrome') {
            try {
                $rendertronUrl = Str::finish(config('laratron.rendertron_url'), '/');

                $client = new Client([
                    'base_uri' => $rendertronUrl.'render/'.URL::current(),
                ]);

                $clientResponse = $client->request('GET');

                $response = new Response($clientResponse->getBody());

                $response->headers->set('Content-Type','text/html');
               
                return $response;
            } catch (BadResponseException $e) {
                Log::error($e->getMessage());
            }
        }

        return $next($request);
    }
}
