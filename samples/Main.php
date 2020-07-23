<?php

/**
 * Main script.
 *
 * This is a sample to use "keinos/mastodon-streaming-api-config" package.
 * Don't forget to `composer require keinos/mastodon-streaming-api-config` before use.
 *
 */

declare(strict_types=1);

namespace KEINOS\SampleApp;

require_once __DIR__ . '/../vendor/autoload.php';

use KEINOS\MSTDN_TOOLS\Config\Config;

$config = new Config([
    'url_host' => 'https://qiitadon.com/',
]);

$info_instance = $config->getInfoInstance();

print_r($info_instance);
