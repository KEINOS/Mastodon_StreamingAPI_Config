<?php

declare(strict_types=1);

namespace KEINOS\Tests;

final class ConstructTest extends TestCase
{
    public function testAllOptionsSet()
    {
        // Use Yahoo!'s HTML page as a valid URL that doesn't
        // return in JSON format.
        $settings = [
            // Must
            'url_host' => 'https://news.yahoo.co.jp/',
            // Optional
            'endpoint_api_instance' => '/categories/domestic',
            'flag_use_cache' => true,
            'id_hash_self' => hash('md5', strval(mt_rand())),
            'prefix_cache' => hash('md5', strval(mt_rand())),
            'ttl_cache' => 60
        ];
        $this->expectException(\Exception::class);
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
    }

    public function testBadEndpoint()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
            'endpoint_api_instance' => '/api/v1/instanco', // typo endpoint to let it fail
        ];
        $this->expectException(\Exception::class);
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
    }

    public function testBasic()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
        ];
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);

        $this->assertIsObject($obj);
    }

    public function testCaching()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
        ];

        $obj    = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
        $expect = $obj->getInfoInstance();

        unset($obj);

        $obj    = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
        $actual = $obj->getInfoInstance();

        $this->assertSame($expect, $actual);
    }

    public function testEmptyArrayArg()
    {
        $settings = [];
        $this->expectException(\Exception::class);
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
    }
    public function testEmptyInstanceInfoWhenCache()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
            'flag_use_cache' => false,
        ];

        $object = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);

        // Change method accessibility
        $reflection = new \ReflectionClass($object);
        $method = $reflection->getMethod('saveCacheInstanceInfo');
        $method->setAccessible(true);

        $this->expectException(\Exception::class);
        $method->invokeArgs($object, [ null ]);
    }

    public function testGetUriStreamingApi()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
        ];
        $conf = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);

        $expect = 'wss://streaming.qiitadon.com:4000';
        $actual = $conf->getUriStreamingApi();

        $this->assertSame($expect, $actual);
    }

    public function testNonCaching()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
            'flag_use_cache' => false,
        ];

        $obj    = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
        $expect = $obj->getInfoInstance();

        unset($obj);

        $obj    = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
        $actual = $obj->getInfoInstance();

        $this->assertSame($expect, $actual);
    }

    public function testValidEndpointButRequiresAccessToken()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
            'endpoint_api_instance' => '/api/v1/conversations',
        ];
        $this->expectException(\Exception::class);
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
    }

    public function testValidEndpointWithBadAccessToken()
    {
        $settings = [
            'url_host' => 'https://qiitadon.com/',
            'endpoint_api_instance' => '/api/v1/statuses',
            'access_token' => hash('sha256', strval(mt_rand())),
        ];
        $this->expectException(\Exception::class);
        $obj = new \KEINOS\MSTDN_TOOLS\Config\Config($settings);
    }
}
