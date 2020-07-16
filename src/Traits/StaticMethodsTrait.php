<?php

/**
 * This file is part of the keinos/mastodon-streaming-api-config package.
 *
 * - Authors, copyright, license, usage and etc.:
 *   - See: https://github.com/KEINOS/Mastodon_StreamingAPI_Config/
 */

declare(strict_types=1);

namespace KEINOS\MSTDN_TOOLS\Config;

use Symfony\Component\HttpClient\HttpClient;

trait StaticMethodsTrait
{
    /**
     * @param  string $access_token
     * @return bool
     */
    public static function isCompliantAccessToken(string $access_token): bool
    {
        if (empty(trim($access_token))) {
            return false;
        }

        if (! self::isStringAlphaNumeric($access_token)) {
            return false;
        }

        // Mastodon's token is 64 byte in length
        if (64 !== strlen($access_token)) {
            return false;
        }

        return true;
    }

    public static function isStringAlphaNumeric(string $string): bool
    {
        // Some server doesn't enable ctype_alnum by default
        //return ctype_alnum($string);

        return (preg_match('/^[a-zA-Z0-9]+$/', $string) > 0);
    }
    /**
     * @param  string $url   The target URL of the server.
     * @return bool          Returns true if the URL is 200 status.
     */
    public static function isUrlAlive(string $url): bool
    {
        $client_http = HttpClient::create();

        $response = $client_http->request('HEAD', $url);

        return (200 === $response->getStatusCode());
    }

    /**
     * Checks if the URL scheme/protocol is "http:". Note that it's not "https:" to check.
     *
     * @param  string $url
     * @return bool
     */
    public static function isUrlProtocolHttp(string $url): bool
    {
        $target = 'http:';

        return ($target === substr(trim($url), 0, strlen($target)));
    }

    public static function isUrlValidFormat(string $url): bool
    {
        return (false !== filter_var($url, \FILTER_VALIDATE_URL));
    }

    /**
     * Request to the Mastodon API endpoint. The endpoint must return in JSON.
     *
     * @param  string $url_api         URL to the API's endpoint.
     * @param  string $access_token    (Optional)
     * @return array<mixed,mixed>
     * @throws \Exception
     */
    public static function requestApi(string $url_api, string $access_token = ''): array
    {
        try {
            if (self::isUrlProtocolHttp($url_api)) {
                $msg = 'Not in "https:" protocol. We do not allow "http:" protocol.';
                throw new \Exception($msg);
            }

            $header = [];
            if (! empty(trim($access_token))) {
                if (! self::isCompliantAccessToken($access_token)) {
                    $msg = 'Invalid access token format.';
                    throw new \Exception($msg);
                }
                $header = [
                    'headers' => [
                        'Authorization' => "Bearer ${access_token}",
                    ]
                ];
            }

            $client_http = HttpClient::create();
            $response = $client_http->request('GET', $url_api, $header);

            // Get contents as array
            return $response->toArray();
        } catch (\Exception $e) {
            $msg = 'Error while requesting to the server.' . PHP_EOL
                 . '- Error details: ' . $e->getMessage() . PHP_EOL;
            throw new \Exception($msg);
        }
    }
}
