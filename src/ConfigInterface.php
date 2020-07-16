<?php

/**
 * This file is part of the keinos/mastodon-streaming-api-config package.
 *
 * - Authors, copyright, license, usage and etc.:
 *   - See: https://github.com/KEINOS/Mastodon_StreamingAPI_Config/
 */

declare(strict_types=1);

namespace KEINOS\MSTDN_TOOLS\Config;

/**
 * Interface to use \KEINOS\MSTDN_TOOLS\Config class.
 *
 * Describe and define public classes here as a user manual/reference.
 */
interface ConfigInterface
{
    /**
     * Instantiates the class.
     *
     * Checks if the URL of the host given is valid/alive, then fetches the
     * server information from the Mastodon API "instance" method.
     *
     * This "instance" information will be cached for an hour by default to
     * lower the quota usage of the API.
     *
     * To change the life time, set the "ttl_cache" key in the settings arg.
     * To disable caching set the "use_cache"
     *
     *
     * @param array<string,string> $settings
     *   Set information of the target server/instance.
     *   Must "keys"
     *     - "url_host" (string)
     *
     *   Optional "key name" => (value type)
     *     [
     *       "access_token" => (string),
     *       "endpoint_api_instance" => (string),
     *       "flag_use_cache" => (bool),
     *       "prefix_cache" => (string),
     *       "id_hash_self" => (string),
     *       "ttl_cache" => (int),
     *     ];
     */
    public function __construct(array $settings);

    /**
     * Property setters。
     *
     * You can set the properties after the instantiation. But NOTE that setting
     * the properties after the instantiation won't take effect to the information
     * fetched from the "instance" API method.
     */
    public function setAccessToken(string $access_token): void;
    public function setEndpointApiInstance(string $path): void;
    public function setFlagUseCache(bool $flag): void;
    public function setIdHashSelf(string $id_hash_self): void;
    /** @param  array<mixed,mixed> $info_instance */
    public function setInfoInstance(array $info_instance): void;
    public function setPrefixCache(string $prefix_cache): void;
    public function setTtlCache(int $ttl): void;
    public function setUrlHost(string $url_host): void;
    public function setUrlApiInstance(string $url_api_instance): void;

    /**
     * Property getters.
     */
    public function getAccessToken(): string;
    public function getEndpointApiInstance(): string;
    public function getFlagUseCache(): bool;
    public function getIdHashSelf(): string;
    /** @return array<mixed,mixed> */
    public function getInfoInstance(): array;
    public function getPrefixCache(): string;
    public function getTtlCache(): int;
    public function getUrlHost(): string;
    public function getUrlApiInstance(): string;
    public function getUriStreamingApi(): string;
}
