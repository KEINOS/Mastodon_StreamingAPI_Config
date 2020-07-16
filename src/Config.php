<?php

/**
 * This file is the main class of the keinos/mastodon-streaming-api-config package.
 *
 * - Reference of the public methods of this class to use:
 *   - See: ./ConfigInterface.php
 *
 * - Authors, copyright, license, usage and etc.:
 *   - See: https://github.com/KEINOS/Mastodon_StreamingAPI_Config/
 *
 * Debug:
 * - To test and analyze the scripts run:
 *   - Debug: `$ composer test all verbose`
 *   - Help: `$ composer test help`
 *   - Note: Composer is required
 */

declare(strict_types=1);

namespace KEINOS\MSTDN_TOOLS\Config;

use Symfony\Component\HttpClient\HttpClient;
use KEINOS\MSTDN_TOOLS\Cache\Cache;

/**
 * This class holds and provides Mastodon server, a.k.a instance, information to
 * receive server-sent messages from Mastodon Streaming API.
 */
class Config implements ConfigInterface
{
    /* Traits */
    use PropertiesTrait;    // Properties and their getter/setter methods as well
    use StaticMethodsTrait;

    /* Constants */
    public const ACCESS_TOKEN_DEFAULT = '';
    public const CACHE_PREFIX_DEFAULT = 'mstdn_tools_cache_';
    public const CACHE_TTL_DEFAULT    = 60 * 60 * 1; // 1 hour
    public const ENDPOINT_API_INSTANCE_DEFAULT = '/api/v1/instance';
    public const FLAG_USE_CACHE_DEFAULT = true;

    /* Methods */

    /**
     * {@inheritdoc}
     *
     * @param  array<string,mixed> $settings
     * @return void
     * @throws \Exception
     */
    public function __construct(array $settings)
    {
        /* Set must settings */
        if (isset($settings['url_host'])) {
            $this->setUrlHost($settings['url_host']);
        } else {
            $msg = '"url_host" key missing. URL of the Mastodon server/instance is required.';
            throw new \Exception($msg);
        }

        /* Set default settings */
        $this->setDefaultSettings();

        /* Set optional settings */
        $this->setOptionalSettings($settings);

        $url_api_instance = $this->generateUrlApiInstance();
        $this->setUrlApiInstance($url_api_instance);

        /* Set server info from API Instance method */
        $info_instance = $this->preloadCacheInstanceInfo();
        if (null === $info_instance) {
            $info_instance = $this->requestApiInstance();
        }
        $this->saveCacheInstanceInfo($info_instance);
        $this->setInfoInstance($info_instance);
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function generateUrlApiInstance(): string
    {
        $url_api_instance = rtrim($this->getUrlHost(), '/') . $this->getEndpointApiInstance();

        if (! self::isUrlAlive($url_api_instance)) {
            $msg = 'Invalid settings given. Can NOT access to the endpoint URL. URL: '
                 . $url_api_instance . PHP_EOL;
            throw new \Exception($msg);
        }

        return $url_api_instance;
    }

    /**
     * Get the WebSocket URI address.
     * @return string
     */
    public function getUriStreamingApi(): string
    {
        $info_instance = $this->getInfoInstance();

        return $info_instance['urls']['streaming_api'];
    }

    /**
     * @return null|mixed
     */
    protected function preloadCacheInstanceInfo()
    {
        $key_cache     = 'info_instance';
        $info_instance = null;

        $cache = new Cache([
            'ttl'    => $this->getTtlCache(),
            'prefix' => $this->getPrefixCache(),
        ]);

        if ($this->getFlagUseCache()) {
            $info_instance = $cache->get('info_instance');
        } else {
            $cache->clear();
        }

        return $info_instance;
    }

    /**
     * @param  mixed $info_instance
     * @return bool
     * @throws \Exception
     */
    protected function saveCacheInstanceInfo($info_instance): bool
    {
        try {
            $cache = new Cache([
                'ttl'    => $this->getTtlCache(),
                'prefix' => $this->getPrefixCache(),
            ]);
            $cache->set('info_instance', $info_instance);
            return true;
        } catch (\Exception $e) {
            $msg = 'Error while getting the server info from the API.' . PHP_EOL
                 . '- Error details: ' . $e->getMessage() . PHP_EOL;
            throw new \Exception($msg);
        }
    }

    /**
     * @return array<mixed,mixed>
     * @throws \Exception
     */
    protected function requestApiInstance(): array
    {
        try {
            $client_http      = HttpClient::create();
            $url_api_instance = $this->getUrlApiInstance();

            // Get contents and return as array
            $response = $client_http->request('GET', $url_api_instance);
            return $response->toArray();
        } catch (\Exception $e) {
            $msg = 'Error while getting the server info from the API.' . PHP_EOL
                 . '- Error details: ' . $e->getMessage() . PHP_EOL;
            throw new \Exception($msg);
        }
    }

    protected function setDefaultSettings(): void
    {
        $this->setAccessToken(self::ACCESS_TOKEN_DEFAULT);
        $this->setEndpointApiInstance(self::ENDPOINT_API_INSTANCE_DEFAULT);
        $this->setFlagUseCache(self::FLAG_USE_CACHE_DEFAULT);
        $this->setIdHashSelf(strval(hash_file('md5', __FILE__)));
        $this->setPrefixCache(self::CACHE_PREFIX_DEFAULT);
        $this->setTtlCache(self::CACHE_TTL_DEFAULT);
    }

    /**
     * @param  array<string,mixed> $settings
     * @return void
     * @throws \Exception
     */
    protected function setOptionalSettings(array $settings): void
    {
        $list_key_to_method = [
            'access_token'          => 'setAccessToken',
            'endpoint_api_instance' => 'setEndpointApiInstance',
            'flag_use_cache'        => 'setFlagUseCache',
            'prefix_cache'          => 'setPrefixCache',
            'id_hash_self'          => 'setIdHashSelf',
            'ttl_cache'             => 'setTtlCache',
        ];

        foreach ($settings as $key => $value) {
            if (isset($list_key_to_method[$key])) {
                $name_method = $list_key_to_method[$key];
                $this->$name_method($value);
            }
        }
    }
}
