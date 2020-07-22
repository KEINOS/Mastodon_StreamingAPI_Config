[![](https://api.travis-ci.org/KEINOS/Mastodon_StreamingAPI_Config.svg?branch=master)](https://travis-ci.org/KEINOS/Mastodon_StreamingAPI_Config/builds "View Build Status in Travis CI")
[![](https://img.shields.io/coveralls/KEINOS/Mastodon_StreamingAPI_Config/master)](https://coveralls.io/github/KEINOS/Mastodon_StreamingAPI_Config?branch=master "View Coverage Status in COVERALLS")
[![](https://img.shields.io/scrutinizer/quality/g/KEINOS/Mastodon_StreamingAPI_Config/master)](https://scrutinizer-ci.com/g/KEINOS/Mastodon_StreamingAPI_Config/?branch=master "View code quality in Scrutinizer")
[![](https://img.shields.io/packagist/php-v/keinos/mastodon-streaming-api-config)](https://github.com/KEINOS/Mastodon_Streaming_API_Config/blob/master/.travis.yml "View version support in Packagist")

# Configuration Settings Class

This PHP class simply holds Mastodon server information from ["instance" API method](https://docs.joinmastodon.org/methods/instance/).

Use this class to get the URI of [Mastodon Streaming API](https://docs.joinmastodon.org/methods/timelines/streaming/) for receiving messages from `server-sent events` or `WebSocket`.

- Note: This class is aimed to be used in other [Mastodon StreamingAPI tools](https://github.com/search?q=user%3AKEINOS+Mastodon_StreamingAPI_).

## Install

```bash
composer require keinos/mastodon-streaming-api-config
```

## Usage

```php
<?php

namespace KEINOS\Sample;

require_once __DIR__ . '/../vendor/autoload.php';

$conf = new \KEINOS\MSTDN_TOOLS\Config\Config([
    'url_host' => 'https://qiitadon.com/', // Your server/instance URL
]);

$info_instance = $conf->getInfoInstance();
$uri_websocket = $conf->getUriStreamingApi();

```

If the server/instance is in [`WHITELIST_MODE`](https://docs.joinmastodon.org/admin/config/#basic) then you will need an access token to get the server information.

```php
<?php

namespace KEINOS\Sample;

require_once __DIR__ . '/../vendor/autoload.php';

use KEINOS\MSTDN_TOOLS\Config\Config;

$conf = new Config([
    'url_host'     => 'https://qiitadon.com/',
    'access_token' => 'YOUR ACCESS TOKEN HERE',
]);

$info_instance = $conf->getInfoInstance();
$uri_websocket = $conf->getUriStreamingApi();
$access_token  = $cong->getAccessToken();

```

- For other methods see the [interface of the Config class](https://github.com/KEINOS/Mastodon_StreamingAPI_Config/blob/master/src/ConfigInterface.php).
  - [./src/ConfigInterface.php](./src/ConfigInterface.php)

## Package Information

- Packagist: https://packagist.org/packages/keinos/mastodon-streaming-api-config
- Source: https://github.com/KEINOS/Mastodon_StreamingAPI_Config
- Issues: https://github.com/KEINOS/Mastodon_StreamingAPI_Config/issues
- License: [MIT](https://github.com/KEINOS/Mastodon_StreamingAPI_Config/blob/master/LICENSE)
- Authors: [KEINOS and the contributors](https://github.com/KEINOS/Mastodon_StreamingAPI_Config/graphs/contributors)