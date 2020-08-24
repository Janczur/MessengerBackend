<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Dotenv\Dotenv;

$builder = new ContainerBuilder();
$loader = new Loader\YamlFileLoader($builder, new FileLocator($servicesPath));
$loader->load('services.yaml');
$builder->compile();

$dumper = new PhpDumper($builder);
file_put_contents(__DIR__ . '/AppContainer.php', $dumper->dump([
    'class' => 'AppContainer'
]));

require __DIR__ . '/AppContainer.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$storagePath = realpath(dirname(__DIR__) . '/storage');
$_ENV['STORAGE_PATH'] = $storagePath;