<?php

/**
 * This file is part of the keinos/mastodon-streaming-api-config package.
 *
 * - Authors, copyright, license, usage and etc.:
 *   - See: https://github.com/KEINOS/Mastodon_StreamingAPI_Config/
 */

declare(strict_types=1);

namespace KEINOS\MSTDN_TOOLS\Config;

trait PropertiesTrait
{
    /** @var string */
    protected $access_token;
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /** @var string */
    protected $endpoint_api_instance;
    public function setEndpointApiInstance(string $path): void
    {
        $this->endpoint_api_instance = $path;
    }
    public function getEndpointApiInstance(): string
    {
        return $this->endpoint_api_instance;
    }

    /** @var bool */
    protected $flag_use_cache;
    public function setFlagUseCache(bool $flag): void
    {
        $this->flag_use_cache = $flag;
    }
    public function getFlagUseCache(): bool
    {
        return $this->flag_use_cache;
    }

    /** @var string */
    protected $id_hash_self;
    public function setIdHashSelf(string $id_hash_self): void
    {
        $this->id_hash_self = $id_hash_self;
    }
    public function getIdHashSelf(): string
    {
        return $this->id_hash_self;
    }

    /** @var array<mixed,mixed> */
    protected $info_instance;
    /** @param  array<mixed,mixed> $info_instance */
    public function setInfoInstance(array $info_instance): void
    {
        $this->info_instance = $info_instance;
    }
    /** @return array<mixed,mixed> */
    public function getInfoInstance(): array
    {
        return $this->info_instance;
    }

    /** @var string */
    protected $prefix_cache;
    public function setPrefixCache(string $prefix_cache): void
    {
        $this->prefix_cache = $prefix_cache;
    }
    public function getPrefixCache(): string
    {
        return $this->prefix_cache;
    }

    /** @var int */
    protected $ttl_cache;
    public function setTtlCache(int $ttl): void
    {
        $this->ttl_cache = $ttl;
    }
    public function getTtlCache(): int
    {
        return $this->ttl_cache;
    }

    /** @var string */
    protected $url_host;
    public function setUrlHost(string $url_host): void
    {
        $this->url_host = $url_host;
    }
    public function getUrlHost(): string
    {
        return $this->url_host;
    }

    /** @var string */
    protected $url_api_instance;
    public function setUrlApiInstance(string $url_api_instance): void
    {
        $this->url_api_instance = $url_api_instance;
    }
    public function getUrlApiInstance(): string
    {
        return $this->url_api_instance;
    }
}
