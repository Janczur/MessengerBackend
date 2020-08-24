<?php
$servicesPath = __DIR__ . '/../../../config/services/cli';
require_once __DIR__ . '/../../../config/bootstrap.php';

use Symfony\Component\Console\Application;

$container = new AppContainer();
$app = new Application();

$app->add($container->get('command.send_message'));

$app->run();