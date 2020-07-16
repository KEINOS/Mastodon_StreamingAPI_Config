<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class RequestApiTest extends TestCase
{
    protected function setUp(): void
    {
        // Avoid too many requests. Mastodon request limit is 1 request/sec.
        sleep(1);
    }

    public function testExistingUrl()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $url = 'https://qiitadon.com/api/v1/custom_emojis';
        $result = $mock->requestApi($url);
        $this->assertArrayHasKey('shortcode', $result[0]);
    }

    public function testExistingUrlWithAccessToken()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $url = 'https://qiitadon.com/api/v1/custom_emojis';
        // MD5 hash does not have enough length as a access token of Mastodon.
        $access_token = hash('sha256', strval(time()));

        // $access_token is random but this endpoint doesn't require access token
        $result = $mock->requestApi($url, $access_token);
        $this->assertArrayHasKey('shortcode', $result[0]);
    }

    public function testExistingUrlWithBadAccessToken()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $url = 'https://qiitadon.com/api/v1/custom_emojis';
        // MD5 hash does not have enough length as a access token of Mastodon.
        $access_token = hash('md5', strval(time()));

        $this->expectException(\Exception::class);
        $result = $mock->requestApi($url, $access_token);
    }

    public function testUrlWithHttpScheme()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $url = 'http://qiitadon.com/api/v1/custom_emojis';

        $this->expectException(\Exception::class);
        $result = $mock->requestApi($url);
    }
}
