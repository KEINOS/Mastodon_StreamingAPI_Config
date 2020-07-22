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
     *   - Keys and values available to set:
     *     [
     *       "url_host"     => (string), // This is a MUST element. The others are optional.
     *       "access_token" => (string),
     *       "endpoint_api_streaming_local"  => (string),
     *       "endpoint_api_streaming_public" => (string),
     *       "endpoint_api_instance" => (string),
     *       "flag_use_cache" => (bool),
     *       "id_hash_self"   => (string),
     *       "prefix_cache"   => (string),
     *       "ttl_cache"      => (int),
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
    public function setEndpointApiStreamingLocal(string $path): void;
    public function setEndpointApiStreamingPublic(string $path): void;
    public function setFlagUseCache(bool $flag): void;
    public function setIdHashSelf(string $id_hash_self): void;
    /** @param  array<mixed,mixed> $info_instance */
    public function setInfoInstance(array $info_instance): void;
    public function setPrefixCache(string $prefix_cache): void;
    public function setTtlCache(int $ttl): void;
    public function setUrlHost(string $url_host): void;
    public function setUrlApiInstance(string $url_api_instance): void;
    public function setUrlApiStreamingLocal(string $url_api_streaming_local): void;
    public function setUrlApiStreamingPublic(string $url_api_streaming_public): void;

    /**
     * Property getters.
     */
    public function getAccessToken(): string;
    public function getEndpointApiInstance(): string;
    public function getEndpointApiStreamingLocal(): string;
    public function getEndpointApiStreamingPublic(): string;
    public function getFlagUseCache(): bool;
    public function getIdHashSelf(): string;
    /** @return array<mixed,mixed> */
    public function getInfoInstance(): array;
    public function getPrefixCache(): string;
    public function getTtlCache(): int;
    public function getUrlHost(): string;
    public function getUrlApiInstance(): string;
    public function getUrlApiStreamingLocal(): string;
    public function getUrlApiStreamingPublic(): string;
}
