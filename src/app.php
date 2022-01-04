#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';

use ASPTest\Command\UserCreateCommand;
use ASPTest\Command\UserCreatePWDCommand;
use Symfony\Component\Console\Application;

$createUser = new UserCreateCommand();
$createPWDUser = new UserCreatePWDCommand();

$application = new Application('Console App', 'v1.0.0');

$application->add($createUser);
$application->add($createPWDUser);
// $application->setDefaultCommand($command->getName());
$application->run();