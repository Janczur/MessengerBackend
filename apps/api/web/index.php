<?php
$servicesPath = __DIR__.'/../../../config/services/api';
require_once __DIR__ . '/../../../config/bootstrap.php';

use Api\AppKernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$kernel = new AppKernel(new AppContainer());

$response = $kernel->handle($request);

$response->send();



