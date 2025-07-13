#!/usr/bin/env php
<?php

declare(strict_types=1);

use ColorPaletteGenerator\Commands\Generate;
use Symfony\Component\Console\Application;

require_once __DIR__."/vendor/autoload.php";

(static function () {
    $application = new Application();
    $command = new Generate();
    $application->add($command);
    $application->setDefaultCommand($command->getName(), true);
    $application->run();
})();
