<?php

/**
 * Main script.
 *
 * Overly-Cautious Development of Hello World!.
 *
 * @standard PSR2
 */

declare(strict_types=1);

namespace KEINOS\SampleApp;

require_once __DIR__ . '/../vendor/autoload.php';

use KEINOS\MSTDN_TOOLS\Config;
use Symfony\Component\HttpClient\HttpClient;

$obj = HttpClient::create();
echo gettype($obj), PHP_EOL;
echo get_class($obj), PHP_EOL;
die;

$obj = new Config('https://mastodon.com/');

echo $obj->getUrlHost() . PHP_EOL;
