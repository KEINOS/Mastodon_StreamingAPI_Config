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

use KEINOS\MSTDN_TOOLS\Config\Config;

$config = new Config([
    'url_host' => 'https://qiitadon.com/',
]);

$info_instance = $config->getInfoInstance();

print_r($info_instance);
