#!/usr/bin/env php
<?php

declare(strict_types=1);

if (php_sapi_name() != 'cli') {
    die("<h1>Only in CLI mode!</h1>");
}

require_once __DIR__ . '/bootstrap.php';

use ColorPaletteGenerator\Commands\Generate;

$command = new Generate();
$application->add($command);
$application->setDefaultCommand($command->getName(), true);
$application->run();
