<?php

declare(strict_types=1);

namespace KEINOS\MSTDN_TOOLS;

use Symfony\Component\HttpClient\HttpClient as HttpClient;

final class Config
{
    /** @var string */
    protected $url_host;

    public function __construct(string $url_host)
    {
        $this->setUrlHost($url_host);
    }

    /**
     * @param  string $url_host  The URL of Mastodon server/instance.
     * @return void
     * @throws \Exception        If the server doesn't return 200 status.
     */
    public function setUrlHost(string $url_host): void
    {
        try {
            /** @phan-suppress-next-line PhanUndeclaredClassMethod */
            $client_http = HttpClient::create();
            $response    = $client_http->request('HEAD', $url_host);

            if (200 !== $response->getStatusCode()) {
                throw new \Exception('The server did not return 200 status.');
            }
            $this->url_host = $url_host;
        } catch (\Exception $e) {
            $msg = 'Error while creating HTTP request client.' . PHP_EOL
                 . '- Error details: ' . $e->getMessage() . PHP_EOL;
            throw new \Exception($msg);
        }
    }

    public function getUrlHost(): string
    {
        if (!isset($this->url_host) || empty($this->url_host)) {
            return '';
        }

        return $this->url_host;
    }
}
