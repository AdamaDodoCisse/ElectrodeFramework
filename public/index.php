<?php

use Electrode\Injector\DIC;
use Electrode\Injector\FIC;
use Electrode\Navigator\Http\Route\RouteManager;
use ElectrodeFramework\FrameworkRouteReader;

define('PAGE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'page');

$filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

if (!file_exists($filename)) {
    require_once PAGE . DIRECTORY_SEPARATOR . 'composer.page.php';
    exit(0);
}

require_once $filename;

$routeReader = FrameworkRouteReader::getInstance();
$routeManager = new RouteManager($routeReader);
try {
    $route = $routeManager->getRouteWhoMatchURL($_GET['u']);
    $fic = new FIC(new DIC());
    $fic->execute($route->getAction(), $route->getParameters());
} catch (Exception $e) {
    require_once PAGE . DIRECTORY_SEPARATOR . '404.page.php';
    exit(0);
}